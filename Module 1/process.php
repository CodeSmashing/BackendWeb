<?php
header("Content-Type: application/json");
include "Easy/e1_constanteEnFunctie.php";
include "Easy/e2_meetkunde.php";
include "Easy/e3_globaleVariabele.php";
include "Easy/e4_variabelen.php";
include "Easy/e5_controlestructurenEnLussen.php";

set_exception_handler(function (Throwable $e) {
	error_log("Uncaught exception: " . $e->getMessage(), 0);
	http_response_code(500);
	echo json_encode(["error" => "An unexpected error occurred. Please try again later."]);
});

$json_response = [];
$assignment = $_POST["assignment"];
$info = json_decode($_POST["info"]);

if (!$assignment) {
	$json_response["serverMessage"] = "No assignment given";
	exit(json_encode($json_response));
}

switch ($assignment) {
	case "e1":
		$radius = (int) $info->radius;

		$json_response["surfaceAreaCirkel"] = calculateSurfaceAreaCirkel($radius);
		break;
	case "e2":
		$rectangleSide1 = (int) $info->rectangleSide1;
		$rectangleSide2 = (int) $info->rectangleSide2;
		$squareSide = (int) $info->squareSide;
		$triangleBase = (int) $info->triangleBase;
		$triangleHeight = (int) $info->triangleHeight;

		global $functionsExecutedCounter;
		$json_response["surfaceAreaRectangle"] = calculateSurfaceAreaRectangle($rectangleSide1, $rectangleSide2);
		$json_response["surfaceAreaSquare"] = calculateSurfaceAreaSquare($squareSide);
		$json_response["surfaceAreaTriangle"] = calculateSurfaceAreaTriangle($triangleBase, $triangleHeight);
		$json_response["functionsExecutedCounter"] = $functionsExecutedCounter;
		break;
	case "e3":
		$rectangleSide1 = (int) $info->rectangleSide1;
		$rectangleSide2 = (int) $info->rectangleSide2;
		$squareSide = (int) $info->squareSide;
		$triangleBase = (int) $info->triangleBase;
		$triangleHeight = (int) $info->triangleHeight;

		global $functionsExecutedCounter;
		calculateSurfaceAreaRectangle($rectangleSide1, $rectangleSide2);
		calculateSurfaceAreaSquare($squareSide);
		calculateSurfaceAreaTriangle($triangleBase, $triangleHeight);

		$json_response["functionsExecutedCounter"] = $functionsExecutedCounter;
		break;
	case "e4":
		$json_response["variabelTest"] = variabelTest();
		break;
	case "e5":
		$json_response["randomNumberResults"] = checkRandomNumber();
		break;
	default:
		break;
}

// If all goes well, exit and send a JSON response
$json_response["serverMessage"] = "success";
exit(json_encode($json_response));
