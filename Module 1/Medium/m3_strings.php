<?php
function splitName($name): array|string {
	if (!str_contains($name, " ")) return "Error: Name must contain a space.";

	$name = explode(" ", $name, 2);
	$firstName = $name[0];
	$lastName = $name[1];
	return [$firstName, $lastName];
}

function combineNames($firstName, $lastName): string {
	$fullname = "$firstName $lastName";
	return $fullname;
}
