<section class="minimized" id="{{ $moduleId }}-assignment-{{ $assignmentId }}">
	<button class="minimize"></button>
	<h2><strong>{{ strtoupper($assignmentId) }}:</strong> {{ $title }}</h2>

	@foreach($descriptionList as $desc)
	@if($desc['tagName'] === 'p')
	<p>{{ $desc['textContent'] }}</p>
	@elseif($desc['tagName'] === 'ul')
	<ul>
		@foreach($desc['items'] as $item)
		<li>
			@if ($item['tagName'] === 'p')
			<p>{{ $item['textContent'] }}</p>
			@endif
		</li>
		@endforeach
	</ul>
	@elseif($desc['className'] === 'code-container')
	<x-assignment-results.code-container
		:elements="$desc['elements']" />
	@endif
	@endforeach

	<x-assignment-results.container :output-list="$outputList" />

	<hr>
</section>
