<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourRequest extends FormRequest
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
          'title' => 'required|string|min:3',
          'description' => 'required|string|',
        ];

        }
        public function messages(){
          return[
            'title.required' => 'title est obligatoire.',
            'description.unique' => 'Cet description existe déjà.',
          ];
        }
    
}
