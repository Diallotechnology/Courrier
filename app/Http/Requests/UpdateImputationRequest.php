<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateImputationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Utilisez la méthode can() pour vérifier l'autorisation en fonction de la politique (Policy) et de l'action
        if ($this->route()->getName() === 'imputation.update') {
            return $this->user()->can('update', $this->route('imputation'));
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
            'priorite' => 'required|string|max:6',
            'observation' => 'string|nullable|max:255',
            'delai' => 'nullable|date',
            'courrier_id' => 'required|exists:courriers,id',
            'departement_id' => 'required|array|exists:departements,id',
            'subdepartement_id' => 'required|array|exists:sub_departements,id',
            'annotation_id' => 'required|array|exists:annotations,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
