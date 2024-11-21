<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'email'  =>'required||email:rcf,dns|unique:employees,email|min:10',
            'phone_number'  =>'required|unique:employees,phone_number|regex:/^09[0-9]{8}$/',
            'first_name'  => 'required',
            'last_name'=> 'required',
            'city'  => 'required',
            'address'  => 'required',
            'salary'  => 'required',
            'hiredate'  => 'required|date',
            'department_id'  =>'required',
            'job_id'  =>'required',
            'service_id'  =>'required',
        ];
    }
    public function messages(): array
    {
        return[
            'email.required'=> 'هذا الحقل مطلوب',
            'email.unique'=> 'الإيميل موجود مسبقاً',
            'email.min'=> 'الايميل يجب أن يتألف من 10 محارف أو أكثر',
            'phone_number.required'=> 'هذا الحقل مطلوب',
            'phone_number.unique'=> 'الرقم موجود مسبقاً',
            'phone_number.regex'=> 'يجب أن يتكون الرقم من 10 خانات وأن يبدأ ب 09',
            'first_name.required'=> 'هذا الحقل مطلوب',
            'last_name.required'=> 'هذا الحقل مطلوب',
            'password.required'=> 'هذا الحقل مطلوب',
            'city.required'=> 'هذا الحقل مطلوب',
            'address.required'=> 'هذا الحقل مطلوب',
            'salary.required'=> 'هذا الحقل مطلوب',
            'hiredate.required'=> 'هذا الحقل مطلوب',
            'hiredate.date'=> 'يجب إدخال تاريخ',
            'department_id.required'=>'هذا الحقل مطلوب',
            'job_id.required'=>'هذا الحقل مطلوب',
            'service_id.required'=>'هذا الحقل مطلوب'
        ];
    }
}
