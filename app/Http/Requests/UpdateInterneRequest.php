<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterneRequest extends FormRequest
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
            'objet'=>'required|string|max:255',
            'confidentiel'=>'required|string|max:3',
            'priorite'=>'required|string|max:6',
            'contenu'=>'string|nullable',
            'delai'=>'nullable|date',
            'files'=> 'nullable',
            // 'files.*'=> 'mimes:pdf',
            'nature_id'=>'required|exists:natures,id',
            'destinataire_id'=>'required|exists:users,id',
        ];
    }
}
