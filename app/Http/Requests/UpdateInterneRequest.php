<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInterneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->route()->getName() === 'interne.update') {
            return $this->user()->can('update', $this->route('interne'));
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'objet' => 'required|string|max:255',
            'confidentiel' => 'required|string|max:3',
            'priorite' => 'required|string|max:6',
            'contenu' => 'string|nullable',
            'delai' => 'nullable|date',
            'files' => 'nullable',
            // 'files.*'=> 'mimes:pdf',
            'nature_id' => 'required|exists:natures,id',
            'destinataire_id' => 'required|exists:users,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
