<?php

namespace App\Helpers;

class PropertyBuilder
{
    public static function build(array $attributes, array $exclude = ['tagName', 'textContent'])
    {
        $propertyString = '';
        foreach ($attributes as $property => $value) {
            if (!in_array($property, $exclude)) {
                $propertyString .= " $property=\"$value\"";
            }
        }
        return $propertyString;
    }
}
