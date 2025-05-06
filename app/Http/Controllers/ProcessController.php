<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ErrorCase;
use App\Helpers\ErrorCode;
use App\Helpers\ExitCode;
use App\Helpers\FormValidator;
use App\Helpers\Response;

class ProcessController extends Controller
{
    public function handle(Request $request)
    {
        $jsonResponse = new Response(ExitCode::REQUEST_SUCCESS);

        if ($request->isMethod('post')) {
            $assignment = $request->input('assignment', null);
            $info = json_decode($request->input('info', null));
            $action = $info && isset($info->action) ? $info->action : null;

            if (!$assignment) {
                $jsonResponse = $jsonResponse->withAdditionalErrors(
                    ErrorCode::MISSING_VALUE,
                    ErrorCase::MISSING_ASSIGNMENT
                );
                return response()->json($jsonResponse->toArray());
            }

            switch ($assignment) {
				case "m1-assignment-e1":
					$radius = (int) $info->radius;

					$jsonResponse = $jsonResponse->withAdditionalData(
						"surfaceAreaCirkel",
						ModulePHPFundamentalsController::calculateSurfaceAreaCirkel($radius)
					);
					break;
				case "m1-assignment-e2":
					$recSideA = (int) $info->recSideA;
					$recSideB = (int) $info->recSideB;
					$squareSide = (int) $info->squareSide;
					$triangleBase = (int) $info->triangleBase;
					$triangleHeight = (int) $info->triangleHeight;

					global $functionsExecutedCounter;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"surfaceAreaRectangle",
						ModulePHPFundamentalsController::calculateSurfaceAreaRectangle($recSideA, $recSideB)
					);
					$jsonResponse = $jsonResponse->withAdditionalData(
						"surfaceAreaSquare",
						ModulePHPFundamentalsController::calculateSurfaceAreaSquare($squareSide)
					);
					$jsonResponse = $jsonResponse->withAdditionalData(
						"surfaceAreaTriangle",
						ModulePHPFundamentalsController::calculateSurfaceAreaTriangle($triangleBase, $triangleHeight)
					);
					$jsonResponse = $jsonResponse->withAdditionalData(
						"functionsExecutedCounter",
						$functionsExecutedCounter
					);
					break;
				case "m1-assignment-e3":
					$recSideA = (int) $info->recSideA;
					$recSideB = (int) $info->recSideB;
					$squareSide = (int) $info->squareSide;
					$triangleBase = (int) $info->triangleBase;
					$triangleHeight = (int) $info->triangleHeight;

					global $functionsExecutedCounter;
					ModulePHPFundamentalsController::calculateSurfaceAreaRectangle($recSideA, $recSideB);
					ModulePHPFundamentalsController::calculateSurfaceAreaSquare($squareSide);
					ModulePHPFundamentalsController::calculateSurfaceAreaTriangle($triangleBase, $triangleHeight);

					$jsonResponse = $jsonResponse->withAdditionalData(
						"functionsExecutedCounter",
						$functionsExecutedCounter
					);
					break;
				case "m1-assignment-e4":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"variabelTest",
						ModulePHPFundamentalsController::variabelTest()
					);
					break;
				case "m1-assignment-e5":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"randomNumberResults",
						ModulePHPFundamentalsController::checkRandomNumber()
					);
					break;
				case "m1-assignment-e6":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"sumResults",
						ModulePHPFundamentalsController::sumNumbers()
					);
					break;
				case "m1-assignment-m1":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"dateTime",
						ModulePHPFundamentalsController::getDateTime()
					);
					break;
				case "m1-assignment-m2":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"currentSeason",
						ModulePHPFundamentalsController::getCurrentSeason()
					);
				case "m1-assignment-m3":
					$inputValue = $info->inputValue;
					if (is_string($inputValue)) {
						$jsonResponse = $jsonResponse->withAdditionalData(
							"returnValue",
							ModulePHPFundamentalsController::splitName($inputValue)
						);
					}
					if (is_array($inputValue)) {
						$jsonResponse = $jsonResponse->withAdditionalData(
							"returnValue",
							ModulePHPFundamentalsController::combineNames($inputValue[0], $inputValue[1])
						);
					}
					break;
				case "m1-assignment-m4":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"statesList",
						ModulePHPFundamentalsController::getStatesList()
					);
					break;
				case "m1-assignment-m5":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"multiplesList",
						ModulePHPFundamentalsController::calculateMultiples()
					);
					break;
				case "m1-assignment-m6":
					$magicSentence = $info->magicSentence;
					$shuffleWord = $info->shuffleWord;
					$palindromeWord = $info->palindromeWord;
					$anagramWord = $info->anagramWord;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"caseMagic",
						ModulePHPFundamentalsController::caseMagic($magicSentence)
					);
					$jsonResponse = $jsonResponse->withAdditionalData(
						"shuffleWord",
						ModulePHPFundamentalsController::shuffleWord($shuffleWord)
					);
					$jsonResponse = $jsonResponse->withAdditionalData(
						"isPalindrome",
						ModulePHPFundamentalsController::isPalindrome($palindromeWord[0])
					);
					$jsonResponse = $jsonResponse->withAdditionalData(
						"isAnagram",
						ModulePHPFundamentalsController::isAnagram($anagramWord[0], $anagramWord[1])
					);
					break;
				case "m1-assignment-h1":
					$statesList = ModulePHPFundamentalsController::getStatesList();
					$jsonResponse = $jsonResponse->withAdditionalData(
						"statesList",
						ModulePHPFundamentalsController::shuffleArray($statesList)
					);
					break;
				case "m1-assignment-h2":
					$statesList = ModulePHPFundamentalsController::getStatesList();
					$letter = $info->letter;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"statesList",
						ModulePHPFundamentalsController::removeArrayStringsWithoutSpecificLetter($statesList, $letter)
					);
					break;
				case "m1-assignment-h3":
					$statesList = ModulePHPFundamentalsController::getStatesList();
					$letter = $info->letter;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"statesList",
						ModulePHPFundamentalsController::removeArrayStringsWithSpecificLetter($statesList, $letter)
					);
					break;
				case "m1-assignment-c1":
					$inputString = $info->inputString;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"textToNumber",
						ModulePHPFundamentalsController::convertTextToNumber($inputString)
					);
					break;
				case "m1-assignment-c2":
					$limit = $info->limit;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"fibonacciSequence",
						ModulePHPFundamentalsController::getFibonacciUpTo($limit)
					);
					break;
				case "m1-assignment-c3":
					$number = $info->number;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"multipleOfTwo",
						ModulePHPFundamentalsController::multipleOfTwo($number)
					);
					break;
                case "m2-assignment-e1":
                case "m2-assignment-e2":
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
                case "m1-assignment-e3":
                    break;
                case "m1-assignment-e4":
                    break;
                case "m1-assignment-m1":
                    break;
                case "m1-assignment-m2":
                    break;
                case "m1-assignment-m3":
                    break;
                case "m1-assignment-h1":
                    break;
                case "m1-assignment-c1":
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
