<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourrierRequest extends FormRequest
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
            'observation'=>'string|nullable|max:255',
            'date'=>'required|date',
            // 'reference'=> 'required',
            // 'numero'=> 'required',
            'files'=> 'nullable',
            // 'files.*'=> 'mimes:png,jpg',
            'nature_id'=>'required|exists:natures,id',
            'correspondant_id'=>'required|exists:correspondants,id',
            'user_id'=>'required|exists:users,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::user()->id,
            // 'reference' => uniqid(),
            // 'numero' => uniqid(),
         ]);
    }
}
