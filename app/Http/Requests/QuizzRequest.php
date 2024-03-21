<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizzRequest extends FormRequest
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
            'grade_id' => 'required|integer',
            'classroom_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'section_id' => 'required|integer',
        ];
        foreach(config('app.languages') as $key => $value){
            $data[$key.'*.Name'] = 'required|string';
        }

        return $data;
    }
}
