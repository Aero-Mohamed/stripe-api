<?php

namespace App\Http\Controllers\API\Stripe;

use App\Entities\Bill;
use App\Http\Controllers\Controller;
use App\Http\Requests\Stripe\ChargeUserRequest;
use App\Http\Traits\ApiResponse;
use App\Services\StripePaymentService;
use Illuminate\Http\JsonResponse;
use Stripe\Exception\ApiErrorException;

class ChargeUserController extends Controller
{
    use ApiResponse;

    /**
     * charging request for a user
     *
     *  This method processes a payment request for the authenticated user by attempting
     *  to charge the user using the Stripe payment service. If the user does not have
     *  a payment method, or if an error occurs during the charge attempt, an appropriate
     *  error response is returned.
     *
     * @authenticated
     * @group Stripe
     * @route POST /api/v1/stripe/charge
     *
     *
     * @bodyParam amount float required The amount to be charged. Example: 29.99
     * @bodyParam currency string required The currency code for the payment. Example: USD
     * @bodyParam description string required A description of the payment. Example: "Subscription for September"
     *
     *
     * @response 200 {
     *      "success": true,
     *      "status_code": 200,
     *      "data": {
     *          "id": "pi_3Pxr2fLZrVU5jGta3mtpME1Q",
     *          "object": "payment_intent",
     *          "amount": 10000,
     *          "amount_capturable": 0,
     *          "amount_details": {
     *              "tip": []
     *          },
     *          "amount_received": 10000,
     *          "application": null,
     *          "application_fee_amount": null,
     *          "automatic_payment_methods": {
     *              "allow_redirects": "always",
     *              "enabled": true
     *          },
     *          "canceled_at": null,
     *          "cancellation_reason": null,
     *          "capture_method": "automatic_async",
     *          "client_secret": "pi_3Pxr2fLZrVU5jGta3mtpME1Q_secret_zqm4jKsxh7swSxhmOXz07jdi3",
     *          "confirmation_method": "automatic",
     *          "created": 1726063029,
     *          "currency": "usd",
     *          "customer": "cus_QpW3Dcpn1DtJIz",
     *          "description": "Charge for user@example.com. One Time Monthly Subscribtion",
     *          "invoice": null,
     *          "last_payment_error": null,
     *          "latest_charge": "ch_3Pxr2fLZrVU5jGta37YiLuH0",
     *          "livemode": false,
     *          "metadata": [],
     *          "next_action": null,
     *          "on_behalf_of": null,
     *          "payment_method": "pm_1Pxr1lLZrVU5jGtawrensV0o",
     *          "payment_method_configuration_details": {
     *              "id": "pmc_1LVAaTLZrVU5jGtaFXrWqZ8L",
     *              "parent": null
     *          },
     *          "payment_method_options": {
     *              "card": {
     *                  "installments": null,
     *                  "mandate_options": null,
     *                  "network": null,
     *                  "request_three_d_secure": "automatic"
     *              }
     *          },
     *          "payment_method_types": [
     *              "card"
     *          ],
     *          "processing": null,
     *          "receipt_email": null,
     *          "review": null,
     *          "setup_future_usage": null,
     *          "shipping": null,
     *          "source": null,
     *          "statement_descriptor": null,
     *          "statement_descriptor_suffix": null,
     *              "status": "succeeded",
     *              "transfer_data": null,
     *              "transfer_group": null
     *      },
     *      "message": "Payment Complete.",
     *      "errors": null
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
     * @param ChargeUserRequest $request
     * @return JsonResponse
     */
    public function __invoke(
        ChargeUserRequest $request
    ): JsonResponse {
        $user = auth_user();

        if (empty($user->getAttribute('pm_id'))) {
            return $this->error(
                message: "No Payment Method Found.",
                statusCode: self::$responseCode::HTTP_BAD_REQUEST
            );
        }

        $bill = Bill::fromRequest();

        try {
            $stripePaymentService = StripePaymentService::init();
            $paymentIntent = $stripePaymentService->charge($user, $bill);
        } catch (ApiErrorException $e) {
            return $this->error(
                message: $e->getMessage(),
                statusCode: $e->getHttpStatus() ?? 422
            );
        }

        return $this->success(
            data: $paymentIntent,
            message: 'Payment Complete.'
        );
    }
}
