<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripForm extends FormRequest
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
     * 
     * Get the error messages for the defined validation rules.
     * 
     * @return array Returns an array of all validator messages.
     * 
     */
    public function messages()
    {
        return [
            'trip-name.required'    => 'U heeft de naam van de reis niet ingevuld.',
            'trip-year.required'    => 'U heeft het jaar van de reis niet ingevuld.',
            'trip-price.required'   => 'U heeft de prijs van de reis niet ingevuld.',
            'trip-mail.email'       => 'U heeft geen geldig email ingevuld.',
        ];
    }    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'trip-name'     => 'required',
            'trip-year'     => 'required',
            'trip-price'    => 'required',
            'trip-mail'     => 'email|nullable',
        ];
    }
}
