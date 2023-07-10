<?php

namespace App\Http\Requests\Company;

use App\Rules\Company\JobUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Company;

class CreateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('company')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'job_no'            => 'required|max:20',
            'job_title'         => 'required|max:50',
            'job_detail'        => 'required|max:1500',
            'location'          => 'required',
            'location_detail'   => 'nullable|max:500',
            'education'         => 'required',
            'language_level'    => 'nullable',
            'occupation'        => 'required|array',
            'industry'          => 'required|array',
            'feature'           => 'required',
            'experienced_count' => 'nullable|numeric',
            'age_max'           => 'nullable|numeric|gte:age_min',
            'age_min'           => 'nullable|numeric',
            'must_condition'    => 'required|max:700',
            'salary_min'        => 'required|numeric|min:1',
            'salary_max'        => 'required|numeric|min:1|gte:salary_min',
            'salary_detail'     => 'nullable|max:500',
            'position_name'     => 'nullable|max:100',
            'job_status'        => 'required',
        ];
    }
}
