<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityForm extends FormRequest
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
            'activity-name.required'    => 'U heeft de naam van de activity niet ingevuld.',
            'activity-start_hour.required'    => 'U heeft de start tijd van de activity niet ingevuld.',
            'activity-end_hour.required'   => 'U heeft de eind tijd van de activity niet ingevuld.',
            'activity-description.required'       => 'U heeft geen beschrijving ingevuld.',
            'activity-location.required'   => 'U heeft geen locatie ingevuld.',
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
            'activity-name'     => 'required',
            'activity-start_hour'     => 'required',
            'activity-end_hour'    => 'required',
            'activity-description'     => 'required',
            'activity-location'     => 'required',
        ];
    }
}
