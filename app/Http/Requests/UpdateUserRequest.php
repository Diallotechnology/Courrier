<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        // Utilisez la méthode can() pour vérifier l'autorisation en fonction de la politique (Policy) et de l'action
        if ($this->route()->getName() === 'user.update') {
            return $this->user()->can('update', $this->route('user'));
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'poste' => ['required', 'string', 'max:150'],
            'role' => ['required'],
            'type' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user->id)],
            'userable_id' => ['required', 'exists:departements,id'],
            'departement_id' => 'nullable|array|exists:departements,id',
            'subdepartement_id' => 'nullable|array|exists:sub_departements,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
