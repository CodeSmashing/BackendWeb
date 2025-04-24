<?php
header("Content-Type: application/json");
include "Easy/e1_constanteEnFunctie.php";

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
		$json_response["surfaceArea"] = calculateSurfaceArea($radius);
		break;
	case "e2":

		break;
	default:
		break;
}

// If all goes well, exit and send a JSON response
$json_response["serverMessage"] = "success";
exit(json_encode($json_response));
