<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoBadWords implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $badWords = [
            'anjing',
            'babi',
            'monyet',
            'bodoh',
            'goblok',
            'tolol',
            'bangsat',
            'brengsek',
            'kontol',
            'memek',
            'asu'
        ];

        $inputText = strtolower($value);

        foreach ($badWords as $word) {
            if (stripos($inputText, $word) !== false) {
                $fail('Mohon gunakan bahasa yang sopan. Pesan Anda mengandung kata yang tidak diperbolehkan.');
                return;
            }
        }
    }
}
