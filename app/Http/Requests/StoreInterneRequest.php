<?php

namespace App\Http\Requests;

use App\Enum\CourrierInterneEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreInterneRequest extends FormRequest
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
            'confidentiel'=>'required|string|max:3',
            'priorite'=>'required|string|max:6',
            'contenu'=>'string|nullable',
            'delai'=>'nullable|date',
            'reference'=> 'required',
            'etat'=> 'required',
            'files'=> 'nullable',
            // 'files.*'=> 'mimes:pdf',
            'nature_id'=>'required|exists:natures,id',
            'user_id'=>'required|exists:users,id',
            'destinataire_id'=>'required|exists:users,id',
            'expediteur_id'=>'required|exists:users,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::user()->id,
            'expediteur_id' => Auth::user()->id,
            'reference' => uniqid(),
            'etat' => CourrierInterneEnum::SEND->value,
         ]);
    }
}
