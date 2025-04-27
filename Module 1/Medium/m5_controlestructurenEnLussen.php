<?php
function calculateMultiples(): array {
	$highestMultiple = 6;
	$multipleLimit = 6;
	$returnArray = array_fill(0, $highestMultiple, []);

	for ($i = 1; $i <= $highestMultiple; $i++) {
		for ($j = 1; $j <= $multipleLimit; $j++) {
			$returnArray[$i - 1][$j - 1] = "$j*$i = " . $j * $i;
		}
	}

	return $returnArray;
}
