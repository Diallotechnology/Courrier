<?php

namespace App\Http\Requests;

use App\Enum\StructureTypeEnum;
use App\Models\Price;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StorePriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->route()->getName() === 'price.update') {
            return $this->user()->can('update', $this->route('price'));
        }

        return $this->user()->can('create', Price::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', new Enum(StructureTypeEnum::class)],
            'temps' => 'required|integer|in:3,6,12',
            'montant' => 'required|integer',
        ];
    }
}
