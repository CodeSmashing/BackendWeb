<?php
function calculateSurfaceAreaRectangle($side1, $side2): float {
	return $side1 * $side2;
}

function calculateSurfaceAreaSquare($side): float {
	return calculateSurfaceAreaRectangle($side, $side);
}

function calculateSurfaceAreaTriangle($base, $height): float {
	return $base * $height / 2;
}
