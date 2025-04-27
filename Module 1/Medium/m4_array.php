<?php
function getStatesList(): array {
	$statesList = ["België", "Denmark", "Frankrijk", "Slovakije", "Portugal", "Griekenland", "Finland", "Italië", "Roemenië"];
	sort($statesList);
	return $statesList;
}
