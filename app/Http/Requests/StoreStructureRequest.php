<?php

namespace App\Http\Requests;

use App\Models\Structure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreStructureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->route()->getName() === 'structure.update') {
            return $this->user()->can('update', $this->route('structure'));
        }
        return  $this->user()->can('create', Structure::class);
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
            'description'=>'required|nullable|string',
            'contact'=>'required|string|min:8',
            'email'=>'required|email|max:255',
            'adresse'=>'required|string|max:255',
            'licence'=>'required|boolean',
            'logo'=>'nullable',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
       return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
