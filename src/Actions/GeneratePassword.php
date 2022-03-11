<?php

namespace MijatovicMilan\LaravelPasswordGenerator\Actions;

use Illuminate\Support\Str;

class GeneratePassword
{
    public function __invoke($length = null, $strength = null)
    {
        $sets = [
            "l" => ['abcdefghjkmnpqrstuvwxyz'],
            "u" => ['ABCDEFGHJKMNPQRSTUVWXYZ'],
            "d" => ['123456789'],
            "s" => ['!#$%&(){}[]'],
        ];

        $length = $length && $length >= config('password-generator.minimum_password_length')
            ? $length
            : config('password-generator.default_password_length');

        $strength = $strength && $strength > 0 && $strength < 4
            ? $strength :
            config('password-generator.default_password_strength');

        $setsCombined = collect($sets)->flatMap(function($value, $key) {
            return $value;
        })
        ->implode('');

        // Add 2 random upper case letters
        $password = Str::substr(str_shuffle($sets['u'][0]), 0, 2);
        // Remove 2 from length
        $length -= 2;

        // Add 1 random lower case letters
        $password .= Str::substr(str_shuffle($sets['l'][0]), 0, 1);
        // Remove 1 from length
        $length -= 1;

        // If password strength is 2 or 3 we will add 1 number between 2 and 5
        if(in_array($strength, [2, 3])) {
            // Get only digits between 2 and 5
            $digitsBetweenTwoAndFive = Str::substr($sets['d'][0], 1, 4);
            // Add 1 random digit between 2 and 5
            $password .= Str::substr(str_shuffle($digitsBetweenTwoAndFive), 0, 1);
            // Remove 1 from length
            $length -= 1;
        }

        // If password strength is 3 we will add 1 symbol
        if($strength === 3) {
            // Add 1 random symbol
            $password .= Str::substr(str_shuffle($sets['s'][0]), 0, 1);
            // Remove 1 from length
            $length -= 1;
        }

        // Add the rest characters from the $setsCombined
        $password .= Str::substr(str_shuffle($setsCombined), 0, $length);

        return str_shuffle($password);
    }
}