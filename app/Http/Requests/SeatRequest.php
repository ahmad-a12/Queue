<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeatRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'number'  =>'required|unique:seats,number',
        ];
    }
    public function messages(): array
    {
        return[
            'number.required'=> 'هذا الحقل مطلوب',
            'number.unique'=> 'الاسم موجود مسبقاً',
        ];
    }
}
