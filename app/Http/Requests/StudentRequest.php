<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'email' => 'required|string|email',
            'password' => 'required|string',
            'nationalitie_id' => 'required|integer',
            'gender_id' => 'required|integer',
            'blood_id' => 'required|integer',
            'grade_id' => 'required|integer',
            'classroom_id' => 'required|integer',
            'section_id' => 'required|integer',
            'date_birth' => 'required|string',
            'academic_year' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ];
        foreach(config('app.languages') as $key => $value){
            $data[$key.'*.Name'] = 'required|string';
        }

        return $data;
    }
}
