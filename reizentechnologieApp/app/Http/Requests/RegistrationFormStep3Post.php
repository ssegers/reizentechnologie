<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormStep3Post extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /* create Email request field from txtEmail and textEmailExtention for validation*/
        $sEmail = $this->input('txtEmailLocalPart').'@'.$this->input('txtEmailDomain');
        $this->merge(array ('txtEmail' => $sEmail));
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
            'txtEmailLocalPart.required' => 'Vul het eerste deel van je mail adres in',
            'txtEmailDomain.required' => 'Vul de domeinnaam van je email adres is',
            'txtEmail.email' => 'Het ingevulde email adres is niet geldig.',
            'txtEmail.unique' => 'Het ingevulde email adres is al in gebruik.',
            'txtGsm.required' => 'Je moet je GSM nummer invullen.',
            'txtGsm.phone' => 'Je moet een geldig GSM nummer invullen.',
            'txtNoodnummer1.required' => 'Je moet minstens 1 noodnummer invullen.',
            'txtNoodnummer1.phone' => 'Je moet een geldig noodnummer 1 invullen.',
            'txtNoodnummer2.phone' => 'Je moet een geldig noodnummer 2 invullen.',
            'radioMedisch.required' => 'Je moet aanduiden of er al dan niet belangrijke medische gegevens zijn.',                     
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
            'txtEmailLocalPart' => 'required',
            'txtEmailDomain' => 'required',
            'txtEmail' => 'email | unique:travellers,email',
            'txtGsm' => 'required|phone:BE,NL',
            'txtNoodnummer1' => 'required|phone:BE,NL',
            'txtNoodnummer2' => 'nullable|phone:BE,NL',
            'radioMedisch' => 'required',
            'txtMedisch' => '',
        ];
    }
        /**
     * Validate request
     * @return
     */
    public function validated()
    { 
        /* create Email request field from txtEmail and textEmailExtention for validation*/
        $sEmail = $this->input('txtEmailLocalPart').'@'.$this->input('txtEmailDomain');
        $this->merge(array ('txtEmail' => $sEmail));

    }
}
