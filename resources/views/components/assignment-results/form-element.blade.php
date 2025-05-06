@php
use App\Helpers\HtmlHelper;
use App\Helpers\PropertyBuilder;

$textContent = $element['textContent'] ?? '';
$propertyString = PropertyBuilder::build($element);
@endphp

@if(HtmlHelper::isSelfClosing($element['tagName']))
<{{ $element['tagName'] }}{!! $propertyString !!} />
@else
<{{ $element['tagName'] }}{!! $propertyString !!}>
	{!! $textContent !!}
</{{ $element['tagName'] }}>
@endif
