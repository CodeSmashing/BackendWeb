<?php
define("PI", 3.1415);

function calculateSurfaceArea($radius): float {
	$surfaceArea = PI * $radius * $radius;
	return $surfaceArea;
}
