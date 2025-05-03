<?php
ini_set("display_errors", 0);
ini_set("log_errors", 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
set_exception_handler(function (Throwable $e) {
    // Log with timestamp and stack trace
    error_log(sprintf(
        "[%s] Uncaught %s: %s in %s:%d\nStack Trace:\n%s",
        date('Y-m-d H:i:s'),
        get_class($e),
        $e->getMessage(),
        $e->getFile(),
        $e->getLine(),
        $e->getTraceAsString()
    ));

	http_response_code(500);
	echo json_encode(["error" => "An unexpected error occurred. Please try again later."]);
	exit;
});

// Preferred folder name would be php-utils/ instead of Easy/ or Medium/
include "Easy/ErrorCase.php";
include "Easy/ErrorCode.php";
include "Easy/ExitCode.php";
include "Easy/FormValidator.php";
include "Easy/Response.php";
// include "Medium/m1_formulierOverMeerderePages.php";
// include "Medium/m2_sessions.php";
// include "Medium/m3_files.php";
// include "Hard/h1_simpeleLogin.php";
// include "Challenge@home/c1_groteForm.php";

$jsonResponse = new Response(ExitCode::REQUEST_SUCCESS);

switch ($_SERVER["REQUEST_METHOD"]) {
	case "POST":
		$assignment = $_POST["assignment"] ?? "";
		$info = json_decode($_POST["info"]) ?? null;
		$_POST = [];
		$action = $info ? $info->action : null;

		if (!$assignment) {
			$jsonResponse = $jsonResponse->withAdditionalErrors(ErrorCode::MISSING_VALUE, ErrorCase::MISSING_ASSIGNMENT);
			break;
		}

		switch ($assignment) {
			case "e1":
			case "e2":
				if (empty(trim($action))) {
					$jsonResponse = $jsonResponse->withAdditionalErrors(ErrorCode::MISSING_VALUE, ErrorCase::MISSING_ACTION);
					break;
				}

				if (empty($info)) {
					$jsonResponse = $jsonResponse->withAdditionalErrors(ErrorCode::MISSING_VALUE, ErrorCase::MISSING_INFO);
					break;
				}

				if (empty($info->validResultList)) {
					$jsonResponse = $jsonResponse->withAdditionalErrors(ErrorCode::MISSING_VALUE, ErrorCase::MISSING_FORM_INFO);
					break;
				}

				$fieldErrorList = FormValidator::validateForm($info->validResultList);

				foreach ($fieldErrorList as $field => $errorList) {
					if (count((array) $errorList) > 0) {
						$jsonResponse->setExitCode(ExitCode::VALIDATION_FAILURE);
						break;
					}
				}

				foreach ($fieldErrorList as $field => $errorList) {
					if (count((array) $errorList) > 0) {
						foreach ($errorList as $errorCode => $errorCaseList) {
							$jsonResponse = $jsonResponse->withAdditionalErrors(ErrorCode::from($errorCode), $errorCaseList);
						}
					} else {
						if ($field === "password") {
							$jsonResponse = $jsonResponse->withAdditionalData($field, $info->validResultList->$field);
							$jsonResponse = $jsonResponse->withAdditionalData("hash", password_hash($info->validResultList->$field, PASSWORD_DEFAULT));
						} else {
							$jsonResponse = $jsonResponse->withAdditionalData($field, $info->validResultList->$field);
						}
					}
				}

				if ($jsonResponse->getExitCode() !== ExitCode::VALIDATION_FAILURE) {
					$jsonResponse->setExitCode(ExitCode::VALIDATION_SUCCESS);
				}
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
		$jsonResponse->setExitCode(ExitCode::REQUEST_FAILURE);
		$jsonResponse = $jsonResponse->withAdditionalErrors(ErrorCode::INVALID_VALUE, ErrorCase::INVALID_REQUEST_METHOD);
		break;
}

// If all goes well, exit and send the JSON response
exit($jsonResponse->toJson());
