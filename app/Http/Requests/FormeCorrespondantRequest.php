<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FormeCorrespondantRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom'=>'required|string|max:70',
            'prenom'=>'required|string|max:70',
            'contact'=>'string|nullable|max:11',
            'fonction'=>'required|string|max:100',
            'email'=> ['required','email','max:255','unique:correspondants,email'],
            'structure_id'=>'required|exists:structures,id',
        ];
    }

    // Rule::unique('correspondants')->ignore($this->correspondant->id)
}
