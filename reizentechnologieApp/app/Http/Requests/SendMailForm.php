<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailForm extends FormRequest
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
            'subject.required' => 'Het onderwerp moet ingevuld zijn',
            'trip.required' => 'De reis moet geselecteerd zijn',
            'message.required' => 'Het bericht moet ingevuld zijn',
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
            'subject' => 'required',
            'trip' => 'required',
            'message' => 'required',
        ];
    }

}
