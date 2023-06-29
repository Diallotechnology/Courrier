<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  $this->user()->can('create', Task::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom'=>'required|string|max:100',
            'type'=>'string|required|max:50',
            'description'=>'string|required',
            'debut'=>'required|date_format:Y-m-d\TH:i',
            'fin'=>'required|date_format:Y-m-d\TH:i',
            'createur_id'=>'required|exists:users,id',
            'imputation_id'=>'nullable|exists:imputations,id',
            'user_id'=>'nullable|array|exists:users,id',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'createur_id' => Auth::user()->id,
         ]);
    }
}
