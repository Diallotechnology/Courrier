<?php

namespace App\Http\Requests;

use App\Models\Licence;
use Illuminate\Foundation\Http\FormRequest;

class ReviewLicenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('review', Licence::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'temps' => 'required|integer|in:3,6,12'
        ];
    }
}
