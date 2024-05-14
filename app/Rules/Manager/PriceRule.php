<?php

namespace App\Rules\Manager;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PriceRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail)
    {
        $filter = filter_var($value, FILTER_VALIDATE_INT) ;

        return $filter ;
    }
}
