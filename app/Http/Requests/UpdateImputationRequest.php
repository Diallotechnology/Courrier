<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImputationRequest extends FormRequest
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
            'priorite'=>'required|string|max:6',
            'observation'=>'string|nullable|max:255',
            'delai'=>'nullable|date',
            'courrier_id'=>'required|exists:courriers,id',
            'departement_id'=>'required|exists:departements,id',
            'annotation_id'=>'required|array|exists:annotations,id',
        ];
    }
}
