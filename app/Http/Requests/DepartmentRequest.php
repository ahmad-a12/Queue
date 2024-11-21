<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'department_name'  =>'required|unique:departments,department_name|min:4',
        ];
    }
    public function messages(): array
    {
        return[
            'department_name.required'=> 'هذا الحقل مطلوب',
            'department_name.unique'=> 'الاسم موجود مسبقاً',
            'department_name.min'=> 'الاسم يجب أن يتألف من أربع أحرف أو أكثر',
        ];
    }
}
