<?php

namespace App\Helpers;

class PlaceholderReplacer
{
    public static function replace(string $text, array $replacements)
    {
        foreach ($replacements as $element) {
            $propertyString = PropertyBuilder::build($element);
            $outputDetail = "<{$element['tagName']}{$propertyString}>{$element['textContent']}</{$element['tagName']}>";

            // Replace only the first occurrence each time
            $text = preg_replace('/\{\.\.\.\}/', $outputDetail, $text, 1);
        }
        return $text;
    }
}
