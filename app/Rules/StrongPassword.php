<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, string): void  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) < 8) {
            return;
        }

        if (
            !preg_match('/[a-z]/', $value) ||     // huruf kecil
            !preg_match('/[A-Z]/', $value) ||     // huruf besar
            !preg_match('/[0-9]/', $value) ||     // angka
            !preg_match('/[\W_]/', $value)        // simbol
        ) {
            $fail('The password must contain at least one uppercase and one lowercase letter, number, and symbol.');
        }
    }
}
