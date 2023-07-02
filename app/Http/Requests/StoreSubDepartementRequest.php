<?php

namespace App\Http\Requests;

use App\Models\SubDepartement;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubDepartementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->route()->getName() === 'subdepartement.update') {
            return $this->user()->can('update', $this->route('subdepartement'));
        }

        return $this->user()->can('create', SubDepartement::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'departement_id' => ['required', 'exists:departements,id'],
            'nom' => 'required|string|max:100',
            'code' => 'required|string|max:15',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
