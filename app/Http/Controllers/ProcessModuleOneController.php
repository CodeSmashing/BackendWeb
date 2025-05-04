<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ErrorCase;
use App\Helpers\ErrorCode;
use App\Helpers\ExitCode;
use App\Helpers\Response;

class ProcessModuleOneController extends Controller
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
					$radius = (int) $info->radius;

					$jsonResponse = $jsonResponse->withAdditionalData(
						"surfaceAreaCirkel",
						ModulePHPFundamentalsController::calculateSurfaceAreaCirkel($radius)
					);
					break;
				case "e2":
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
				case "e3":
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
				case "e4":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"variabelTest",
						ModulePHPFundamentalsController::variabelTest()
					);
					break;
				case "e5":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"randomNumberResults",
						ModulePHPFundamentalsController::checkRandomNumber()
					);
					break;
				case "e6":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"sumResults",
						ModulePHPFundamentalsController::sumNumbers()
					);
					break;
				case "m1":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"dateTime",
						ModulePHPFundamentalsController::getDateTime()
					);
					break;
				case "m2":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"currentSeason",
						ModulePHPFundamentalsController::getCurrentSeason()
					);
				case "m3":
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
				case "m4":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"statesList",
						ModulePHPFundamentalsController::getStatesList()
					);
					break;
				case "m5":
					$jsonResponse = $jsonResponse->withAdditionalData(
						"multiplesList",
						ModulePHPFundamentalsController::calculateMultiples()
					);
					break;
				case "m6":
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
				case "h1":
					$statesList = ModulePHPFundamentalsController::getStatesList();
					$jsonResponse = $jsonResponse->withAdditionalData(
						"statesList",
						ModulePHPFundamentalsController::shuffleArray($statesList)
					);
					break;
				case "h2":
					$statesList = ModulePHPFundamentalsController::getStatesList();
					$letter = $info->letter;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"statesList",
						ModulePHPFundamentalsController::removeArrayStringsWithoutSpecificLetter($statesList, $letter)
					);
					break;
				case "h3":
					$statesList = ModulePHPFundamentalsController::getStatesList();
					$letter = $info->letter;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"statesList",
						ModulePHPFundamentalsController::removeArrayStringsWithSpecificLetter($statesList, $letter)
					);
					break;
				case "c1":
					$inputString = $info->inputString;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"textToNumber",
						ModulePHPFundamentalsController::convertTextToNumber($inputString)
					);
					break;
				case "c2":
					$limit = $info->limit;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"fibonacciSequence",
						ModulePHPFundamentalsController::getFibonacciUpTo($limit)
					);
					break;
				case "c3":
					$number = $info->number;
					$jsonResponse = $jsonResponse->withAdditionalData(
						"multipleOfTwo",
						ModulePHPFundamentalsController::multipleOfTwo($number)
					);
					break;
				default:
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
