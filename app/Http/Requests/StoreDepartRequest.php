<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreDepartRequest extends FormRequest
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
            'objet'=>'required|string|max:255',
            'reference'=>'required|string|max:25',
            'confidentiel'=>'required|string|max:3',
            'priorite'=>'required|string|max:6',
            'observation'=>'string|nullable|max:255',
            'date'=>'required|date',
            'files'=> 'nullable',
            // 'files.*'=> 'mimes:pdf',
            'courrier_id'=>'nullable|exists:courriers,id',
            'nature_id'=>'required|exists:natures,id',
            'correspondant_id'=>'required|exists:correspondants,id',
            'user_id'=>'required|exists:users,id',
            'structure_id'=>'required|exists:structures,id',
        ];


    }

    protected function prepareForValidation()
    {
        $structureId = Auth::user()->userable->structure_id ?: Auth::user()->userable->departement->structure_id;
        $this->merge([
            'user_id' => Auth::user()->id,
            'structure_id' => $structureId,
         ]);
    }

    protected function failedValidation(Validator $validator)
    {
       return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}


