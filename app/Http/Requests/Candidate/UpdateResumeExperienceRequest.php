<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResumeExperienceRequest extends FormRequest
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

            'certificate' => 'required',
            'skill' => 'required',
            'current_salary' => 'required',
            'current_salary' => 'required|numeric|min:10',
            'occupation_ids' => 'required|array',
            'industry_ids' => 'required|array',
            'attachment' => 'required|mimes:doc,pdf,docx,xlsx,xls,txt|max:10000'
        ];
    }
}
