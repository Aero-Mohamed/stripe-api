<?php

namespace App\Http\Requests\Stripe;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardExpirationMonth;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardNumber;

class UpdatePaymentMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {

        if (app()->environment('local') || app()->environment('testing')) {
            return [
                'card_number' => ['required'],
                'expiration_year' => ['required'],
                'expiration_month' => ['required'],
                'cvc' => ['required']
            ];
        }
        return [
            'card_number' => ['required', new CardNumber()],
            'expiration_year' => ['required', new CardExpirationYear('expiration_month')],
            'expiration_month' => ['required', new CardExpirationMonth('expiration_year')],
            'cvc' => ['required', new CardCvc('card_number')]
        ];
    }
}
