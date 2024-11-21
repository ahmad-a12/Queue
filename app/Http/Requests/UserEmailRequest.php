<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEmailRequest extends FormRequest
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
            'email' => 'required|unique:employees,email|min:10|email:rcf,dns',
            'name'  =>'required|min:4',
            'password'=>'required|min:8',
        ];
    }
    public function messages(): array
    {
        return[
            'email.required'=> 'هذا الحقل مطلوب',
            'email.unique'=> 'الايميل مسجل مسبقاً',
            'email.min'=> 'الايميل يجب أن يتألف من 10 محارف أو أكثر',
            'name.required'=> 'هذا الحقل مطلوب',
            'name.min'=> 'الاسم يجب أن يتألف من 4 محارف أو أكثر',
            'password.required'=> 'هذا الحقل مطلوب',
            'password.min'=> 'كلمة السر يجب أن تتألف من 8 أحرف أو أكثر',
        ];
    }
}
