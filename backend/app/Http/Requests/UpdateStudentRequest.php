<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:students,email,' . $this->student->id,
            'birth_date' => [
                'sometimes',
                'required',
                'date',
                'before_or_equal:' . today()->toDateString(),
                'after_or_equal:1900-01-01'
            ],
            'enable' => 'sometimes|required|boolean',
            'school_class_id' => 'sometimes|required|exists:school_classes,id',
        ];
    }
}
