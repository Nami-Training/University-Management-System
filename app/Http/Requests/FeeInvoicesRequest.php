<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeInvoicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required',
            'grade_id' => 'required|integer',
            'student_id' => 'required|integer',
            'classroom_id' => 'required|integer',
            'fee_id' => 'required|integer',
            'description' => 'required|string|max:255',
        ];
    }
}
