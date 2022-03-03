<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ExpressionRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        foreach (explode(',',trim($value,',')) as $item){
            if(!preg_match('/^(\d)*[mdhis]$/', $item)){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your Expressions must have one of the following letters and you can use the number before that and separate them with a comma. for example: m,4m,7d,d,h,8i,25s,s';
    }
}
