<?php
function variabelTest(): array {
	$variabel1 = "";
	$variabel2 = null;
	$variabel3 = [];
	$variabel4 = [1, 2, 3];
	$variabel5 = "test";
	$returnArray = [];

	$returnArray["variabel1"] = isset($variabel1);
	$returnArray["variabel2"] = isset($variabel2);
	$returnArray["variabel3"] = empty($variabel3);
	$returnArray["variabel4"] = empty($variabel4);
	$returnArray["variabel5"] = [isset($variabel5), empty($variabel5)];

	return $returnArray;
}
