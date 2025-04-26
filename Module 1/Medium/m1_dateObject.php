<?php
function getDateTime(): array {
	$returnArray = [];

	$returnArray["date"] = date("Y-m-d");
	$returnArray["dateTime"] = date("d/m/y h:m:s");
	$returnArray["dateTimeFull"] = date("l d/m/Y, h:m:s");

	return $returnArray;
}
