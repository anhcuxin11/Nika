<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'name_person' => 'required|max:255',
            'email_company' => 'required|max:255',
            'phone_company' => 'required|max:255',
            'fax_company' => 'required|max:255',
            'address' => 'required|max:255',
        ];
    }
}
