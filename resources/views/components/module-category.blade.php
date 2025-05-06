<article class="minimized" id="{{ $moduleId }}-{{ $category }}">
	<button class="minimize"></button>
	<h2>{{ ucfirst($category) }}</h2>

	@foreach ($assignmentList as $assignment)
	<x-assignment-section
		:moduleId="$moduleId"
		:assignmentId="$assignment['id']"
		:title="$assignment['title']"
		:descriptionList="$assignment['descriptionList']"
		:outputList="$assignment['outputList']" />
	@endforeach
</article>
