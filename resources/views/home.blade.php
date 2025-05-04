<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Home</title>
</head>

<body>
	<h1>Hello world</h1>

	<ul>
		<li>
			<a href="{{ route('module', ['moduleId' => 1]) }}">Module 1</a>
		</li>
		<li>
			<a href="{{ route('module', ['moduleId' => 2]) }}">Module 2</a>
		</li>
	</ul>
</body>

</html>
