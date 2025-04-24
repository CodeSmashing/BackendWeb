<?php
define("PI", 3.1415);

function calculateSurfaceAreaCirkel($radius): float {
	$surfaceArea = PI * $radius * $radius;
	return $surfaceArea;
}
