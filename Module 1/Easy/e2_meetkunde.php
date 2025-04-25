<?php
function calculateSurfaceAreaRectangle($side1, $side2): float {
	global $functionsExecutedCounter;
	$functionsExecutedCounter++;
	return $side1 * $side2;
}

function calculateSurfaceAreaSquare($side): float {
	global $functionsExecutedCounter;
	$functionsExecutedCounter++;
	return calculateSurfaceAreaRectangle($side, $side);
}

function calculateSurfaceAreaTriangle($base, $height): float {
	global $functionsExecutedCounter;
	$functionsExecutedCounter++;
	return $base * $height / 2;
}
