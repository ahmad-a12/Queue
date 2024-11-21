<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'service_name'  =>'required|unique:services,service_name|min:4',
        ];
    }
    public function messages(): array
    {
        return[
            'service_name.required'=> 'هذا الحقل مطلوب',
            'service_name.unique'=> 'الاسم موجود مسبقاً',
            'service_name.min'=> 'الاسم يجب أن يتألف من 4 محارف أو أكثر',
        ];
    }
}
