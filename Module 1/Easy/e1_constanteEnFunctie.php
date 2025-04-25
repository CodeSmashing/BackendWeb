<?php
define("PI", 3.1415);

function calculateSurfaceAreaCirkel($radius): float {
	global $functionsExecutedCounter;
	$functionsExecutedCounter++;
	$surfaceArea = PI * $radius * $radius;
	return $surfaceArea;
}
