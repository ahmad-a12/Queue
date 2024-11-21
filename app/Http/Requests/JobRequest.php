<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'job_title'  =>'required|unique:jobs,job_title|min:3',
            'min_salary'=>'min:0|numeric',
            'max_salary'=>'min:0|numeric',
            'department_id'  =>'required',
        ];
    }
    public function messages(): array
    {
        return[
            'job_title.required'=> 'هذا الحقل مطلوب',
            'job_title.unique'=> 'الاسم موجود مسبقاً',
            'job_title.min'=> 'الاسم يجب أن يتألف من 3 محارف أو أكثر',
            'min_salary.min'=> 'يجب إدخال قيمة أكبر من الصفر',
            'max_salary.min'=> 'يجب إدخال قيمة أكبر من الصفر',
            'department_id.required'=>'هذا الحقل مطلوب'
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->input('max_salary') <= $this->input('min_salary')) {
                $validator->errors()->add('max_salary', 'The max salary must be greater than the min salary.');
            }
        });
    }
}
