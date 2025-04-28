<?php
function multipleOfTwo($number) {
	$isMultiple = $number % 2;
	$returnArray = [
		"isMultiple" => null,
		"power" => null
	];

	$log = log($number, 2);
	$returnArray["isMultiple"] = $isMultiple == 0 ? true : false;
	$returnArray["power"] = is_int($log) ? $log : round($log);
	return $returnArray;
}
