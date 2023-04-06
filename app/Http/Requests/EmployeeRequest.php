<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'job_title_id' => 'required|exists:job_titles,id',
            'job_level_id' => 'required|exists:job_levels,id',
            'father_name' => 'required|string|max:100',
            'mother_name' => 'required|string|max:100',
            'death_of_birth' => 'required|date',
            'religion' => 'nullable',
            'nid' => 'nullable|numeric',
            'resign_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'gender' => 'required',
            'phone' => 'required|string',
            'join_date' => 'required|date',
            'salary' => 'required|numeric',
        ];
    }
}
