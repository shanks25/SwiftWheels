<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOutstationPriceRequest extends FormRequest
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
     */
    public function rules()
    {
        return [
            'source_id' => 'required|numeric|exists:outstations,id',
            'destination_id' => 'required|numeric|exists:outstations,id',
            'fixed' => 'required',
            'distance' => 'required',
            'price' => 'required'
        ];
    }
}
