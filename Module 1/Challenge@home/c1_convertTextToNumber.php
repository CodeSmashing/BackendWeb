<?php
function convertTextToNumber($text): int {
	$returnNumber = 0;
	$textArray = explode(";", $text);
	$textNumericValue = [
		"nul" => 0,
		"een" => 1,
		"twee" => 2,
		"drie" => 3,
		"vier" => 4,
		"vijf" => 5,
		"zes" => 6,
		"zeven" => 7,
		"acht" => 8,
		"negen" => 9
	];
	foreach ($textArray as $key) {
		$returnNumber = $returnNumber * 10 + $textNumericValue[$key];
	}

	return $returnNumber;
}
