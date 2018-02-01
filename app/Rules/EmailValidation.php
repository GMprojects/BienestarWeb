<?php

namespace BienestarWeb\Rules;

use Illuminate\Contracts\Validation\Rule;
use BienestarWeb\User;

class EmailValidation implements Rule
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
         $user = User::where('email', $value )->first();
         if( $user != null ){
            if ($user->estado == '0') {
               $email = $user->email;
               $user->email = $email.'-';
               $user->update();
               return true;
            }else{
               return false;
            }
         }else{
            return true;
         }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo :attribute ya está en uso.';
    }
}
