<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStructureRequest extends FormRequest
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
            'nom'=>'required|string|max:100',
            'description'=>'required|nullable|string|max:200',
            'contact'=>'required|string|min:8',
            'email'=>'required|email|max:255',
            'logo'=>'nullable',
        ];
    }
}
