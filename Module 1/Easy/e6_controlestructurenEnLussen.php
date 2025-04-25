<?php
function sumNumbers() {
	$counter = 1;
	$returnResult = 0;

	while ($counter <= 30) {
		$returnResult += $counter++;
	}

	return $returnResult;
}
