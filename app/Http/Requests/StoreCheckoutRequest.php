<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \Exception
     */
    public function rules()
    {
        $currentYear = (new \Carbon\Carbon())->year;

        return [
            'address' => 'required',
            'name' => 'required',
            'shippingPrice' => 'required|numeric',
            'cardHolder' => 'required',
            'cardNumber' => 'required|digits:16',
            'month' => 'required|numeric|between:1,12',
            'year' => "required|numeric|min:{$currentYear}",
            'securityCode' => 'required|numeric|digits:3',
        ];
    }
}
