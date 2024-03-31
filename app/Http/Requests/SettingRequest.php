<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'school_name' => 'required|string',
            'school_title' => 'required|string',
            'address' => 'required|string',
            'current_session' => 'required|string',
            'phone' => 'required|string',
            'school_email' => 'required|email',
            'end_first_term' => 'required|date',
            'end_second_term' => 'required|date',
        ];
    }
}
