<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormAddZip extends FormRequest
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
            'city.reuired' => 'je moet een stad of gemeente invullen bij het toevoegen van een postcode',
            'city.max' => 'de ingevulde gemeentenaam is te lang',
            'city.unique' => 'De naam van de gemeente bestaat al in de database',
            'zip_code.required' => 'Je moet een postcode invullen',
            'zip_code.postal_code' => 'je hebt een niet geldige postcode ingevuld',
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
            'city' =>'required | max:50 |unique:zips,city',
            'zip_code' => 'required|postal_code:NL,BE',
            //
        ];
    }
}
