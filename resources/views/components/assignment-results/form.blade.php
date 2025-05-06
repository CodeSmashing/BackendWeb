<form id="{{ $id }}" method="{{ $method }}">
	@foreach($elements as $element)
	<x-assignment-results.form-element :element="$element" />
	@endforeach
</form>
