<section class="results-container">
	@foreach($outputList as $output)
	@if($output['tagName'] === 'form')
	<x-assignment-results.form
		:id="$output['id']"
		:method="$output['method']"
		:elements="$output['elements']" />
	@elseif($output['tagName'] === 'p')
	<x-assignment-results.paragraph
		:tagName="$output['tagName']"
		:textContent="$output['textContent']"
		:replacements="$output['replacements'] ?? null" />
	@else
	<x-assignment-results.tag :output="$output" />
	@endif
	@endforeach
</section>
