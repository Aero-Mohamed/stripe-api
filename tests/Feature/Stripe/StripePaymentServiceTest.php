<?php

namespace Tests\Feature\Stripe;

use App\Entities\CreditCard;
use App\Models\User;
use App\Services\StripePaymentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Stripe\Exception\ApiErrorException;
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

        // Ensure the Stripe secret key is set for testing
        $secretKey = config('services.stripe.secret');

        // Verify the secret key is a valid string
        if (!is_string($secretKey) || empty($secretKey)) {
            throw new \InvalidArgumentException('Stripe secret key is not properly set in the configuration.');
        }

        // Initialize the StripeClient with the correct secret key
        $stripeClient = new StripeClient($secretKey);

        // Use the StripeClient in your service
        $this->stripeService = new StripePaymentService($stripeClient);
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

}
