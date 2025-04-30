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

$jsonResponse = new stdClass();

function setResponse(bool $success, string $exitReason, string $serverMessage, array $info = []): bool {
	global $jsonResponse;
	$jsonResponse->success = $success;
	$jsonResponse->exitReason = $exitReason;
	$jsonResponse->serverMessage = $serverMessage;

	if (!empty($info)) {
		foreach ($info as $key => $value) {
			if (!in_array($key, ["exitReason", "serverMessage"])) {
				$jsonResponse->$key = $value;
			}
		}
	}
	return true;
}

switch ($_SERVER["REQUEST_METHOD"]) {
	case "POST":
		$assignment = $_POST["assignment"] ?? "";
		$info = json_decode($_POST["info"]) ?? "";
		$_POST = [];

		if (!$assignment) {
			setResponse(
				false,
				"assignment-missing",
				"No assignment ID was given."
			);
			break;
		}

		$action = $info ? $info->action : "";
		$username = $info ? $info->username : "";
		$password = $info ? $info->password : "";

		switch ($assignment) {
			case "e1":
				$validation = validateUserInfo($username, $password);

				setResponse(
					$validation->success,
					$validation->exitReason,
					$validation->serverMessage,
					$validation->success ? ["hash" => $validation->hash] : []
				);
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
		break;
	default:
		break;
}

// If all goes well, exit and send the JSON response
exit(json_encode($jsonResponse));
