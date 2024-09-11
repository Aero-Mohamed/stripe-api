<?php

namespace Tests\Feature\Stripe;

use App\Entities\Bill;
use App\Entities\CreditCard;
use App\Models\User;
use App\Services\StripePaymentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\StripeClient;
use Tests\TestCase;

class StripePaymentServiceTest extends TestCase
{
    use RefreshDatabase;

    public StripePaymentService $stripeService;

    protected function setUp(): void
    {
        parent::setUp();

        // Use the StripeClient in your service
        $this->stripeService = StripePaymentService::init();
    }

    /**
     * Test the updatePaymentMethod function with real Stripe API calls.
     *
     * @return void
     * @throws ApiErrorException
     */
    public function testUpdatePaymentMethodWithStripeSandbox()
    {
        // Create a mock user and credit card entity
        $user = User::factory()->create(['email' => 'testuser@example.com', 'name' => 'Test User']);
        $creditCard = new CreditCard(
            card_number: '4242424242424242',
            expiration_year: 2025,
            expiration_month: 12,
            cvc: 123,
        );

        // Call the method and verify it does not throw an exception
        $paymentMethod = $this->stripeService->updatePaymentMethod($user, $creditCard);

        // Assert that a PaymentMethod was returned and has the expected attributes
        $this->assertInstanceOf(PaymentMethod::class, $paymentMethod);
        $this->assertNotEmpty($paymentMethod->id);
        $this->assertEquals('card', $paymentMethod->type);
    }

    /**
     * Test the charge function with real Stripe API calls.
     *
     * @return void
     * @throws ApiErrorException
     */
    public function testChargingStripePaymentMethodSandbox()
    {
        /** @var User $user */
        $user = User::factory()->create(['email' => 'testuser@example.com', 'name' => 'Test User']);
        $creditCard = new CreditCard(
            card_number: '4242424242424242',
            expiration_year: 2025,
            expiration_month: 12,
            cvc: 123,
        );
        $bill = new Bill(
            amount: 100,
            currency: 'USD',
            description: 'Test Description.'
        );

        // Call the method and verify it does not throw an exception
        $paymentMethod = $this->stripeService->updatePaymentMethod($user, $creditCard);
        $user->updatePaymentMethod($paymentMethod);

        $paymentIntent = $this->stripeService->charge($user, $bill);

        $this->assertInstanceOf(PaymentIntent::class, $paymentIntent);
        $this->assertNotEmpty($paymentIntent->id);
        $this->assertEquals(10000, $paymentIntent->amount);
        $this->assertEquals($paymentMethod->id, $paymentIntent->payment_method);
        $this->assertEquals('succeeded', $paymentIntent->status);
    }
}
