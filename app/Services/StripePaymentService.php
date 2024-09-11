<?php

namespace App\Services;

use App\Entities\Bill;
use App\Entities\CreditCard;
use App\Models\User;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
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
     * self Initialization
     * @return StripePaymentService
     */
    public static function init(): StripePaymentService
    {
        // Ensure the Stripe secret key is set for testing
        $secretKey = config('services.stripe.secret');

        // Verify the secret key is a valid string
        if (!is_string($secretKey) || empty($secretKey)) {
            throw new \InvalidArgumentException('Stripe secret key is not properly set in the configuration.');
        }

        // Initialize the StripeClient with the correct secret key
        $stripeClient = new StripeClient($secretKey);

        return new self($stripeClient);
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

    /**
     * off_session & confirm
     * read docs: https://docs.stripe.com/api/payment_intents/create#create_payment_intent-off_session
     * @param Bill $bill
     * @param User $user
     * @return PaymentIntent
     * @throws ApiErrorException
     */
    public function charge(User $user, Bill $bill): PaymentIntent
    {
        return $this->stripe->paymentIntents->create([
            'amount' => intval($bill->amount * 100), // Amount in cents
            'currency' => $bill->currency,
            'customer' => $user->getAttribute('stripe_id'),
            'payment_method' => $user->getAttribute('pm_id'),
            'off_session' => true,
            'confirm' => true, // Automatically confirm the payment intent
            'description' => 'Charge for ' . $user->getAttribute('email') . '. ' . $bill->description,
            'receipt_email' => $user->getAttribute('email'),
        ]);
    }
}
