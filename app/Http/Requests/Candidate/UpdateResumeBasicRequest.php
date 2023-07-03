<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResumeBasicRequest extends FormRequest
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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'age' => 'required|numeric|max:100',
            'phone' => 'required|max:11',
            'country' => 'required',
            'address' => 'required',
        ];
    }
}
