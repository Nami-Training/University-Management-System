<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'specialization_id' => 'required|integer',
            'gender_id' => 'required|integer',
            'Joining_Date' => 'required|string'
        ];
        foreach(config('app.languages') as $key => $value){
            $data[$key.'*.Name'] = 'required|string';
            $data[$key.'*.Address'] = 'required|string';
        }

        return $data;
    }
}
