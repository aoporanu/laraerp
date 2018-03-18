<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPromoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasRole('agent');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'promo.*.name' => 'required',
            'promo.*.name.cutie' => 'required|numeric'
        ];
    }
}
