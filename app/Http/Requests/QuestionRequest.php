<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'score' => 'required|integer',
            'quiz_id' => 'required|integer',
        ];
        foreach(config('app.languages') as $key => $value){
            $data[$key.'*.title'] = 'required|string';
            $data[$key.'*.answers'] = 'required|string';
            $data[$key.'*.right_answer'] = 'required|string';
        }

        return $data;
    }
}
