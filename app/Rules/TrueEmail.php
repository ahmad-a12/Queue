<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class TrueEmail implements Rule
{
    public function passes($attribute, $value)
    {
        // Validate the email address using RFCValidation
        $validator = new EmailValidator();
        return $validator->isValid($value, new RFCValidation());
    }

    public function message()
    {
        return 'البريد الإلكتروني غير صحيح. يرجى إدخال عنوان بريد إلكتروني صحيح.';
    }
}
