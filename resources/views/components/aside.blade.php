<aside class="hidden">
	@foreach($moduleList as $moduleId => $categoryList)
	<x-ul
		:moduleId="$moduleId"
		:categoryList="$categoryList" />

	@if (!$loop->last)
	<hr>
	@endif
	@endforeach
</aside>
