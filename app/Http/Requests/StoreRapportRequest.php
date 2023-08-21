<?php

namespace App\Http\Requests;

use App\Models\Rapport;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRapportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Rapport::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'objet' => 'required|string|max:255',
            'type' => 'required|string|max:200',
            'user_id' => 'required|exists:users,id',
            'courrier_id' => 'nullable|exists:courriers,id',
            'structure_id' => 'required|exists:structures,id',
            'contenu' => 'nullable|string',
            'files' => 'nullable|sometimes|array',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::user()->id,
            'structure_id' => Auth::user()->structure(),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
