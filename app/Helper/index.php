<?php

if (! function_exists('firstWord')) {
    /**
     * Take first word from passed value
     *
     * @param string value
     * @param bool capitalize
     */
    function firstWord(string $value, ?bool $capitalize = false): string
    {
        $result = str()->of(strtolower($value))->explode(' ')->get(0);

        return $capitalize ? ucfirst($result) : strtolower($result);
    }
}

if (! function_exists('firstLetter')) {
    /**
     * Take first letter from passed value
     *
     * @param string value
     * @param bool capitalize
     */
    function firstLetter(string $value, ?bool $capitalize = true): string
    {
        $result = str(string: $value)->substr(start: 0, length: 1);

        return $capitalize ? $result->upper() : $result->lower();
    }
}

if (! function_exists('generateUsername')) {
    /**
     * Take first letter from passed value
     *
     * @param string value
     * @param ?int number_length
     */
    function generateUsername(string $value, ?int $number_length = 5): string
    {
        $max = (int) str_pad(string: '9', length: $number_length, pad_string: '9');

        $result = firstWord(value: $value, capitalize: false) . mt_rand(min: 11111, max: $max);

        return $result;
    }
}
