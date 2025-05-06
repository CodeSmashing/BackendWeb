<ul>
	@foreach ($categoryList as $category => $categoryAssignmentList)
	@foreach ($categoryAssignmentList as $assignment)
	<li>
		<a href="#{{ $moduleId }}-assignment-{{ $assignment['id'] }}">
			<strong>{{ ucfirst($assignment['id']) }}</strong> {{ $assignment['title'] }}
		</a>
	</li>
	@endforeach
	@endforeach
</ul>
