<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Exercises</title>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
	<main>
		<input type="hidden" id="assignment" value="" disabled>
		<x-aside :moduleList="$moduleList" />

		<h1>Exercises</h1>

		@foreach($moduleList as $moduleId => $categoryList)
		<x-module-section
			:moduleId="$moduleId"
			:categoryList="$categoryList" />
		@endforeach
	</main>
</body>

<script src="{{ asset('js/init.js') }}"></script>

</html>
