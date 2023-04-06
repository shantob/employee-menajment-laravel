<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'leave_type' => 'required|string',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'days' => 'nullable|integer',
            'leave_reason' => 'nullable',
            'status' => 'nullable',
            'approved_by' => 'nullable|exists:users,id',
        ];
    }
}
