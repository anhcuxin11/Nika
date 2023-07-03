<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResumeRequirementRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requirementSalary' => 'required|numeric|min:10',
            'requirementEmployment' => 'required|array|min:1',
            'occupation_ids' => 'required|array|min:1',
            'location_ids' => 'required|array|min:1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'requirementSalary.required' => 'Please be sure to specify your desired annual income.',
        ];
    }
}
