<?php
function getFibonacciUpTo($limit): array  {
	$returnArray = [0, 1];

	for ($i = 2; $i < $limit; $i++) { 
		$returnArray[$i] = $returnArray[$i - 2] + $returnArray[$i - 1];
	}
	return $returnArray;
}
