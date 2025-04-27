<?php
function removeArrayStringsWithSpecificLetter($array, $letter): array {
	$filtered = array_filter($array, function($item) use ($letter) {
		return strtolower($item)[0] == $letter ? false : true;
	});
	return array_values($filtered);
}
