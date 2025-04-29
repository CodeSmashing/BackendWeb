<?php
header("Content-Type: application/json");
include "Easy/e1_simpeleForm.php";
include "Easy/e2_simpeleForm.php";
include "Easy/e3_simpeleCookies.php";
include "Easy/e4_simpeleCookies.php";
include "Medium/m1_formulierOverMeerderePages.php";
include "Medium/m2_sessions.php";
include "Medium/m3_files.php";
include "Hard/h1_simpeleLogin.php";
include "Challenge@home/c1_groteForm.php";

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
		break;
	case "e2":
		break;
	case "e3":
		break;
	case "e4":
		break;
	case "m1":
		break;
	case "m2":
		break;
	case "m3":
		break;
	case "h1":
		break;
	case "c1":
		break;
	default:
		break;
}

// If all goes well, exit and send a JSON response
$json_response["serverMessage"] = "success";
exit(json_encode($json_response));
