<div class="code-container">
	@foreach ($elements as $element)
	@if ($element['tagName'] === 'p')
	<x-assignment-results.paragraph
		:tagName="$element['tagName']"
		:textContent="$element['textContent']"
		:replacements="null" />
	@endif
	@endforeach
</div>
