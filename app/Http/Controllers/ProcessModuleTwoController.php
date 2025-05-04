<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ErrorCase;
use App\Helpers\ErrorCode;
use App\Helpers\ExitCode;
use App\Helpers\FormValidator;
use App\Helpers\Response;

class ProcessModuleTwoController extends Controller
{
    public function handle(Request $request)
    {
        $jsonResponse = new Response(ExitCode::REQUEST_SUCCESS);

        if ($request->isMethod('post')) {
            $assignment = $request->input('assignment', null);
            $info = json_decode($request->input('info', null));
            $action = $info ? $info->action : null;

            if (!$assignment) {
                $jsonResponse = $jsonResponse->withAdditionalErrors(
                    ErrorCode::MISSING_VALUE,
                    ErrorCase::MISSING_ASSIGNMENT
                );
                return response()->json($jsonResponse->toArray());
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
                    // Should probably handle unknown assignments
                    break;
            }
        } else {
            $jsonResponse->setExitCode(ExitCode::REQUEST_FAILURE);
            $jsonResponse = $jsonResponse->withAdditionalErrors(
                ErrorCode::INVALID_VALUE,
                ErrorCase::INVALID_REQUEST_METHOD
            );
        }

		// If all goes well, exit and send the JSON response
        return response()->json($jsonResponse->toArray());
    }
}
