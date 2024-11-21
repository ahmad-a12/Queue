<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserNumberRequest extends FormRequest
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
            'phone_number' => 'required|unique:employees,phone_number|regex:/^09[0-9]{8}$/',
            'name'  =>'required|min:4',
            'password'=>'required|min:8',
        ];
    }
    public function messages(): array
    {
        return[
            'phone_number.required'=> 'هذا الحقل مطلوب',
            'phone_number.unique'=> 'الرقم مسجل مسبقاً',
            'phone_number.regex'=> 'يجب أن يتكون الرقم من 10 خانات وأن يبدأ ب 09',
            'name.required'=> 'هذا الحقل مطلوب',
            'name.min'=> 'الاسم يجب أن يتألف من 4 محارف أو أكثر',
            'password.required'=> 'هذا الحقل مطلوب',
            'password.min'=> 'كلمة السر يجب أن تتألف من 8 محارف أو أكثر',
        ];
    }
}
