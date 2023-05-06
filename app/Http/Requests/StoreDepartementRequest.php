<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreDepartementRequest extends FormRequest
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
            'structure_id' => 'required|exists:structures,id',
            'nom'=>'required|string|max:100',
            'code'=>'required|string|max:15'
        ];
    }

    protected function prepareForValidation()
    {
        // $this->merge(['structure_id' => $this->input('structure_id') ? : Auth::user()->departement->structure->id ]);
    }
}
