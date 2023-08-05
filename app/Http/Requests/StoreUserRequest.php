<?php

namespace App\Http\Requests;

use App\Enum\RoleEnum;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', User::class);
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
            'type' => ['required', 'string', 'max:50', Rule::in(['departement', 'subdepartement'])],
            'userable_id' => ['required', 'string'],
            'sexe' => ['required', 'string'],
            'role' => ['required', new Enum(RoleEnum::class)],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'departement_id' => 'nullable|array|exists:departements,id',
            'subdepartement_id' => 'nullable|array|exists:sub_departements,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
