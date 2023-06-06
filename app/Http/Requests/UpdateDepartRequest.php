<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateDepartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->route()->getName() === 'depart.update') {
            return $this->user()->can('update', $this->route('depart'));
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
            'confidentiel'=>'required|string|max:3',
            'priorite'=>'required|string|max:6',
            'observation'=>'string|nullable|max:255',
            'date'=>'required|date',
            'files'=> 'nullable',
            // 'files.*'=> 'mimes:pdf',
            'nature_id'=>'required|exists:natures,id',
            'correspondant_id'=>'required|exists:correspondants,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
       return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
