<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
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
        $data = [
            'grade_id' => 'required|string',
            'classroom_id' => 'required|string',
            // 'teacher_id' => 'required|array',
            'Status' => 'required|integer|in:1,0',
        ];
        foreach(config('app.languages') as $key => $value){
            $data[$key.'*.Name'] = 'required|string';
        }
        return $data;
    }
}
