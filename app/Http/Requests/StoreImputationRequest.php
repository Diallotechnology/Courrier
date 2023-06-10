<?php

namespace App\Http\Requests;

use App\Models\Imputation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreImputationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  $this->user()->can('create', Imputation::class);
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
            'numero'=>'nullable',
            'notif'=> 'required|boolean',
            'courrier_id'=>'required|exists:courriers,id',
            'departement_id'=>'required|array|exists:departements,id',
            'annotation_id'=>'required|array|exists:annotations,id',
            'user_id'=>'required|exists:users,id',
            'structure_id'=>'required|exists:structures,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::user()->id,
            'structure_id' => Auth::user()->structure(),
            'numero' => 'test',
         ]);
    }

    protected function failedValidation(Validator $validator)
    {
       return toastr()->error('la validation a echoué verifiez vos informations!');
    }
}
