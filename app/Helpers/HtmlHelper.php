<?php

namespace App\Helpers;

class HtmlHelper
{
	public static function selfClosingTags(): array
	{
		return ['input', 'img', 'br', 'hr', 'meta', 'link'];
	}

    public static function isSelfClosing(string $tagName): bool
    {
        return in_array(strtolower($tagName), self::selfClosingTags());
    }
}
