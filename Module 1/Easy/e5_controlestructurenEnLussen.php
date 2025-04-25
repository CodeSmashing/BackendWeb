<?php
function checkRandomNumber(): array {
	$counter = 0;
	$returnArray = [];

	while ($counter != 100) {
		$randomNumber = rand(1, 100);
		if (in_array($randomNumber, [10, 20, 30])) {
			array_push($returnArray, "Het nummer is gelijk aan $randomNumber");
		} else {
			array_push($returnArray, "Het nummer was niet wat we zochten");
		}
		$counter++;
	}

	return $returnArray;
}
