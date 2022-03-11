<?php

use MijatovicMilan\LaravelPasswordGenerator\Actions\GeneratePassword;

it('should return password with default length of characters', function () {
    $password = app(GeneratePassword::class)();

    expect($password)->toHaveLength(config('password-generator.default_password_length'));
});

it('should return password with length of twenty characters', function () {
    $password = app(GeneratePassword::class)(20);

    expect($password)->toHaveLength(20);
});

it('should return password with minimum length of characters', function () {
    $password = app(GeneratePassword::class)(1);

    expect($password)->toHaveLength(config('password-generator.minimum_password_length'));
});

it('should return weak password with at least 2 upper case letters and 1 lower case letter', function () {
    $password = app(GeneratePassword::class)(6, 1);

    expect(numberOfUpperCaseCharacters($password))->toBeGreaterThanOrEqual(2);
    expect(numberOfLowerCaseCharacters($password))->toBeGreaterThanOrEqual(1);
});

it('should return medium password with at least 2 upper case letters, 1 lower case letter and 1 number between 2 and 5', function () {
    $password = app(GeneratePassword::class)(6, 2);

    expect(numberOfUpperCaseCharacters($password))->toBeGreaterThanOrEqual(2);
    expect(numberOfLowerCaseCharacters($password))->toBeGreaterThanOrEqual(1);
    expect(numberOfDigitsBetweenTwoAndFive($password))->toBeGreaterThanOrEqual(1);
});

it('should return strong password with at least 2 upper case letters, 1 lower case letter, 1 number between 2 and 5 and 1 symbol', function () {
    $password = app(GeneratePassword::class)(6, 3);

    expect(numberOfUpperCaseCharacters($password))->toBeGreaterThanOrEqual(2);
    expect(numberOfLowerCaseCharacters($password))->toBeGreaterThanOrEqual(1);
    expect(numberOfDigitsBetweenTwoAndFive($password))->toBeGreaterThanOrEqual(1);
    expect(numberOfSymbols($password))->toBeGreaterThanOrEqual(1);
});



function numberOfUpperCaseCharacters(string $password)
{
    return collect(str_split($password))
        ->map(function ($character) {
            return ctype_upper($character) ? $character : null;
        })
        ->filter()
        ->count();
}

function numberOfLowerCaseCharacters(string $password)
{
    return collect(str_split($password))
        ->map(function ($character) {
            return ctype_lower($character) ? $character : null;
        })
        ->filter()
        ->count();
}

function numberOfDigitsBetweenTwoAndFive(string $password)
{
    return collect(str_split($password))
        ->map(function ($character) {
            return is_numeric($character) && $character >= 2 && $character <= 5 ? $character : null;
        })
        ->filter()
        ->count();
}

function numberOfSymbols(string $password)
{
    $symbols = '!#$%&(){}[]';

    return collect(str_split($password))
        ->map(function ($character) use ($symbols) {
            return in_array($character, str_split($symbols)) ? $character : null;
        })
        ->filter()
        ->count();
}
