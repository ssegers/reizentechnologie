<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormStep1Post extends FormRequest
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
            'txtStudentNummer.required' => 'Je Studenten-/docentennummer moet ingevuld worden.',
            'txtStudentNummer.regex' => 'Een studenten-/docentennummer moet beginnen met een r of een u of een b voor begeleiders',
            'txtStudentNummer.min' => 'Een studenten-/docentennummer heeft 1 letter en 7 cijfers',
            'txtStudentNummer.max' => 'Een studenten-/docentennummer heeft 1 letter en 7 cijfers',
            'txtStudentNummer.unique' => 'Deze r-/u-/b-nummer is al in gebruik. Als je denkt dat dit niet kan, vraag om hulp op de contactpagina door een email te sturen.',
            'dropReis.required' => 'Je moet een reis kiezen.',
            'Study.required' => 'Je moet een opleiding kiezen.',
            'Mayor.required' => 'Je moet een afstudeerrichting kiezen.',
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
            'dropReis' => 'required',
            'txtStudentNummer' => 'required | filled | regex:^[rubRUB]^ | min:8 | max:8 | unique:users,username',
            'Study' => 'required',
            'Major' => 'required',
        ];
    }
}
