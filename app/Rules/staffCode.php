<?php

namespace App\Rules;

use App\Models\StaffCode as ModelsStaffCode;
use Illuminate\Contracts\Validation\Rule;

class staffCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $staffCode = ModelsStaffCode::first()->staff_code;
        return $value == $staffCode;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid staff code';
    }
}
