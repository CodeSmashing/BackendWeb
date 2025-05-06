<section aria-labelledby="{{ $moduleId }}-heading">
	<h2 id="{{ $moduleId }}-heading">Module {{ str_replace('m', '', $moduleId) }}</h2>

	@foreach($categoryList as $category => $categoryAssignmentList)
	<x-module-category
		:moduleId="$moduleId"
		:category="$category"
		:assignmentList="$categoryAssignmentList" />
	@endforeach
</section>
