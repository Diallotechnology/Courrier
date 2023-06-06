<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateRapportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->route()->getName() === 'rapport.update') {
            return $this->user()->can('update', $this->route('rapport'));
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

            'objet'=>'required|string|max:255',
            'type'=>'required|string|max:200',
            'courrier_id'=>'nullable|exists:courriers,id',
            'contenu'=> 'nullable|string',
            'files'=> 'nullable|sometimes|array',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
       return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
