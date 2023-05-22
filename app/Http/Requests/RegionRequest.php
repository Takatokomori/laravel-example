<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:155",
            'studentIds' => 'required|array',
            'studentIds.*' => Rule::exists('students', 'id'),
            'prices' => 'required|array',
            'prices.*' => 'nullable|numeric|min:0',
        ];
    }
}
