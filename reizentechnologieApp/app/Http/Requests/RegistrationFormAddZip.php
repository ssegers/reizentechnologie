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
            'city.max' => 'Jde ingevulde gemeentenaam is te lang',
            'city.unique' => 'De naam van de gemeente bestaat al in de database',
            'zip_code.required' => 'Je moet een postcode invullen',
            'zip_code.numeric' => 'De postcode is niet geldig',
            'zip_code.min' => 'De postcode is niet geldig',
            'zip_code.max' => 'De postcode is niet geldig',            
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
            'zip_code' => 'required|numeric|min:1000|max:9999',
            //
        ];
    }
}
