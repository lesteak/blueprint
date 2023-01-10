<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Validator;

/**
 * Email-specific wrapper for the validator
 */
class EmailValidator
{
    public static function for(string $email = null, array $rules = []): \Illuminate\Validation\Validator
    {
        $validator = Validator::make(
            [
                'email' => $email
            ],
            [
                'email' => array_merge(
                    ['email:rfc,dns'],
                    $rules
                )
            ]
        );

        return $validator;
    }

    /**
     * Quick determiner for whether an email address is valid for when you don't
     * care about the vaildation messages.
     *
     * @param string|null $email
     *
     * @return boolean
     */
    public static function isValid(string $email = null)
    {
        return static::for($email)->passes();
    }
}
