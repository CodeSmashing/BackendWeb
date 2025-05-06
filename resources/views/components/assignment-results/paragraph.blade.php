@php
use App\Helpers\PlaceholderReplacer;

// If there are replacement elements and placeholders in the text
if (is_array($replacements) && count($replacements) > 0 && str_contains($textContent, '{...}')) {
$textContent = PlaceholderReplacer::replace($textContent, $replacements);
}
@endphp
<{{ $tagName }}>
	{!! $textContent !!}
</{{ $tagName }}>
