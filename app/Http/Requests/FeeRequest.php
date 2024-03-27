<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
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
            'amount' => 'required',
            'grade_id' => 'required|integer',
            'classroom_id' => 'required|integer',
            'Fee_type' => 'required|string',
            'year' => 'required|string',
            'description' => 'required|string|max:255',
        ];

        foreach(config('app.languages') as $key => $value){
            $data[$key.'*.title'] = 'required|string';
        }

        return $data;
    }
}
