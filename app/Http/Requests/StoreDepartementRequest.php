<?php

namespace App\Http\Requests;

use App\Models\Departement;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreDepartementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->route()->getName() === 'departement.update') {
            return $this->user()->can('update', $this->route('departement'));
        }

        return $this->user()->can('create', Departement::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'structure_id' => 'required|exists:structures,id',
            'nom' => 'required|string|max:100',
            'code' => 'required|string|max:15',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
