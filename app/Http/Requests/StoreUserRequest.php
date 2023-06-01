<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Enum\RoleEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'poste' => ['required', 'string', 'max:150'],
            'role' => ['required', new Enum(RoleEnum::class)],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
       return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
