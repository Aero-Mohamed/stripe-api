<?php

namespace App\Services;

use App\Entities\CreditCard;
use App\Models\User;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentMethod;
use Stripe\StripeClient;

class StripePaymentService
{
    protected StripeClient $stripe;

    public function __construct(StripeClient $stripeClient = null)
    {
        $this->stripe = $stripeClient ?? new StripeClient(config('services.stripe.secret'));
    }

    /**
     * Creates a new Stripe customer.
     *
     * @param User $user
     * @return Customer
     * @throws ApiErrorException
     */
    private function createCustomer(User $user): Customer
    {
        $customer = $this->stripe->customers->create([
            'email' => $user->getAttribute('email'),
            'name' => $user->getAttribute('name'),
        ]);
        $user->setAttribute('stripe_id', $customer->id);
        $user->save();

        return $customer;
    }

    /**
     * Retrieves an existing Stripe customer or creates a new one.
     *
     * @param User $user
     * @return Customer
     * @throws ApiErrorException
     */
    private function retrieveCustomer(User $user): Customer
    {
        $stripeId = $user->getAttribute('stripe_id');

        return $stripeId ? $this->stripe->customers->retrieve($stripeId) : $this->createCustomer($user);
    }

    /**
     * Creates a new Stripe payment method.
     *
     * @param CreditCard $creditCard
     * @return PaymentMethod
     * @throws ApiErrorException
     */
    private function createPaymentMethod(CreditCard $creditCard): PaymentMethod
    {
        return $this->stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => $creditCard->card_number,
                'exp_month' => $creditCard->expiration_month,
                'exp_year' => $creditCard->expiration_year,
                'cvc' => $creditCard->cvc,
            ],
        ]);
    }

    /**
     * Retrieves an existing Stripe payment method.
     *
     * @param User $user
     * @return PaymentMethod|null
     * @throws ApiErrorException
     */
    private function retrievePaymentMethod(User $user): ?PaymentMethod
    {
        $paymentMethodId = $user->getAttribute('pm_id');

        return $paymentMethodId ? $this->stripe->paymentMethods->retrieve($paymentMethodId) : null;
    }

    /**
     * Updates the payment method for a user.
     *
     * @param User $user
     * @param CreditCard $creditCard
     * @return PaymentMethod
     * @throws ApiErrorException
     */
    public function updatePaymentMethod(User $user, CreditCard $creditCard): PaymentMethod
    {
        $customer = $this->retrieveCustomer($user);

        $existingPaymentMethod = $this->retrievePaymentMethod($user);

        if ($existingPaymentMethod && $existingPaymentMethod->customer === $customer->id) {
            $existingPaymentMethod->detach();
        }

        $payment_method = $this->createPaymentMethod($creditCard);

        $payment_method->attach([
            'customer' => $customer->id,
        ]);

        return $payment_method;
    }
}
