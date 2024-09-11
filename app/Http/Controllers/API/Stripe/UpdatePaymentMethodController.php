<?php

namespace App\Http\Controllers\API\Stripe;

use App\Entities\CreditCard;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stripe\UpdatePaymentMethodRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponse;
use App\Services\StripePaymentService;
use Illuminate\Http\JsonResponse;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class UpdatePaymentMethodController extends Controller
{
    use ApiResponse;

    /**
     * Update Payment Method
     *
     * This method is invoked when a user requests to update their payment method. It utilizes the
     * StripePaymentService to update the user's payment method details on Stripe and then updates
     * the user's payment method in the local application. If an error occurs during the Stripe API
     * call, it returns an error response with the appropriate message and HTTP status code.
     *
     * @authenticated
     * @group Stripe
     * @route POST /api/register
     *
     * @bodyParam card_number string required The credit card number of the user. Example: 4242424242424242
     * @bodyParam expiration_year int required The expiration year of the credit card. Example: 2025
     * @bodyParam expiration_month int required The expiration month of the credit card. Example: 12
     * @bodyParam cvc int required The CVC (Card Verification Code) of the credit card. Example: 123
     * @response 200 {
     *      "success": true,
     *      "status_code": 200,
     *      "data": {
     *          "id": 1,
     *          "name": "John Doe",
     *          "email": "johndoe@example.com",
     *          "card": {
     *              "card_last_four": "4242",
     *              "card_type": "card"
     *          }
     *      },
     *      "message": "Payment Method Updated."
     *      "errors": [],
     * }
     *
     * @response 402 {
     *      "success": false,
     *      "status_code": 402,
     *      "data": null,
     *      "message": "Your card was declined.",
     *      "errors": []
     * }
     *
     * @param UpdatePaymentMethodRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        UpdatePaymentMethodRequest $request
    ): JsonResponse {
        $user = auth_user();
        $creditCard = CreditCard::fromRequest();

        try {
            $stripePaymentService = StripePaymentService::init();
            $paymentMethod = $stripePaymentService->updatePaymentMethod($user, $creditCard);
        } catch (ApiErrorException $e) {
            return $this->error(
                message: $e->getMessage(),
                statusCode: $e->getHttpStatus() ?? 422
            );
        }

        $user->updatePaymentMethod($paymentMethod);

        return $this->success(
            data: new UserResource($user),
            message: 'Payment Method Updated.'
        );
    }
}
