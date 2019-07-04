<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProfileEdit extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
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
            'LastName.required'     => 'U heeft geen achternaam ingevuld.',
            'FirstName.required'    => 'U heeft geen voornaam ingevuld.',
            'IBAN.required'         => 'U heeft geen IBAN-nummer ingevuld.',
            'iban'                  => 'U heeft geen geldig IBAN-nummer ingevuld.',
            'bic'                   => 'U heeft geen geldig BIC-nummer ingevuld.',
            'BirthDate.required'    => 'U heeft geen geboortedatum ingevuld.',
            'Birthplace.required'   => 'U heeft geen geboorteplaats ingevuld.',
            'Nationality.required'  => 'U heeft geen nationaliteit ingevuld.',
            'Address.required'      => 'U heeft geen adres ingevuld.',
            'Country.required'      => 'U heeft geen land ingevuld.',

            'Phone.required'        => 'U heeft geen GSM-nummer ingevuld.',
            'Phone.phone'           => 'U heeft geen geldig GSM-nummer ingevuld.',
            'icePhone1.required'    => 'U heeft bij \'noodnummer 1\' niets ingevuld.',
            'icePhone1.phone'       => 'U heeft bij \'noodnummer 1\' geen geldig nummer ingevuld.',
            'icePhone2.phone'       => 'U heeft bij \'noodnummer 2\' geen geldig nummer ingevuld.',
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
            'LastName'      => 'required',
            'FirstName'     => 'required',
            'IBAN'          => 'required|iban',
            'BIC'           => 'required|bic',

            'BirthDate'     => 'required',
            'Birthplace'    => 'required',
            'Nationality'   => 'required',
            'Address'       => 'required',
            'Country'       => 'required',

            'Phone'         => 'required|phone:BE,NL',
            'icePhone1'     => 'required|phone:BE,NL',
            'icePhone2'     => 'nullable|phone:BE,NL'
        ];
    }
}
