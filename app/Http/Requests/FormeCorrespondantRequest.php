<?php

namespace App\Http\Requests;

use App\Models\Correspondant;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class FormeCorrespondantRequest extends FormRequest
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
            'nom'=>'required|string|max:70',
            'contact'=>'string|nullable|max:11',
            'fonction'=>'required|string|max:100',
            'email'=> ['required','email','max:255','unique:correspondants,email',Rule::unique(Correspondant::class,'email')->ignore($this->id)],
            'structure_id'=>'required|exists:structures,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
       return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
