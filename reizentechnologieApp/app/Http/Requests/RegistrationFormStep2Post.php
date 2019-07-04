<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormStep2Post extends FormRequest
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
            'required' => 'The :attribute field must be filled in',
            'txtNaam.required' => 'Je moet je achternaam invullen.',
            'txtVoornaam.required' => 'Je moet je voornaam invullen.',
            'gender.required' => 'Je moet een geslacht kiezen.',
            'txtNationaliteit.required' => 'je moet je nationaliteit opgeven.',
            'dateGeboorte.required' => 'Je moet je geboorte datum ingeven.',
            'dateGeboorte.date_format' => 'De waarde die je hebt ingevuld hebt bij geboorte datum in ongeldig',
            'txtGeboorteplaats.required' => 'Je moet je geboorte plaats ingeven.',
            'txtAdres.required' => 'Je moet je adres ingeven.',
            'dropGemeente.required' => 'Je moet je gemeente ingeven.',
            'txtLand.required' => 'Je moet je land ingeven',            
            'txtBank.required' => 'Je moet je IBAN nummer ingeven.',
            'iban' => 'Je moet een geldig IBAN nummer ingeven.',
            'txtBic.required' => 'Je moet je BIC nummer ingeven.',
            'bic' => 'Je moet een geldig BIC nummer ingeven',
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
            'txtNaam' => 'required',
            'txtVoornaam' => 'required',
            'gender' => 'required',
            'txtNationaliteit' => 'required',
            'dateGeboorte' => 'required',
            'txtGeboorteplaats' => 'required',
            'txtAdres' => 'required',
            'dropGemeentes' => 'required',
            'txtLand' => 'required',
            'txtBank' => 'required | iban',
            'txtBic' => 'required | bic',
        ];
    }
}
