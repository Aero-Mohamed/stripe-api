<?php

namespace App\Http\Requests\Stripe;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChargeUserRequest extends FormRequest
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
        return [
            'amount'        => 'required|numeric|gt:0',
            'currency'      => 'required|string:max:3',
            'description'   => 'required|string:max:500',
        ];
    }
}
