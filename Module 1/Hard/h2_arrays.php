<?php
function removeArrayStringsWithoutSpecificLetter($array, $letter): array {
	$filtered = array_filter($array, function($item) use ($letter) {
		return strtolower($item)[0] == $letter ? true : false;
	});
	return array_values($filtered);
}
