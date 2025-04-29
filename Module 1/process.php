<?php
header("Content-Type: application/json");
include "Easy/e1_constanteEnFunctie.php";
include "Easy/e2_meetkunde.php";
include "Easy/e3_globaleVariabele.php";
include "Easy/e4_variabelen.php";
include "Easy/e5_controlestructurenEnLussen.php";
include "Easy/e6_controlestructurenEnLussen.php";
include "Medium/m1_dateObject.php";
include "Medium/m2_dateObjectEnControlestructuren.php";
include "Medium/m3_strings.php";
include "Medium/m4_array.php";
include "Medium/m5_controlestructurenEnLussen.php";
include "Medium/m6_stringsEnFuncties.php";
include "Hard/h1_arrays.php";
include "Hard/h2_arrays.php";
include "Hard/h3_arrays.php";
include "Challenge@home/c1_convertTextToNumber.php";
include "Challenge@home/c2_fibonacci.php";
include "Challenge@home/c3_veelvouden.php";

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
		$recSideA = (int) $info->recSideA;
		$recSideB = (int) $info->recSideB;
		$squareSide = (int) $info->squareSide;
		$triangleBase = (int) $info->triangleBase;
		$triangleHeight = (int) $info->triangleHeight;

		global $functionsExecutedCounter;
		$json_response["surfaceAreaRectangle"] = calculateSurfaceAreaRectangle($recSideA, $recSideB);
		$json_response["surfaceAreaSquare"] = calculateSurfaceAreaSquare($squareSide);
		$json_response["surfaceAreaTriangle"] = calculateSurfaceAreaTriangle($triangleBase, $triangleHeight);
		$json_response["functionsExecutedCounter"] = $functionsExecutedCounter;
		break;
	case "e3":
		$recSideA = (int) $info->recSideA;
		$recSideB = (int) $info->recSideB;
		$squareSide = (int) $info->squareSide;
		$triangleBase = (int) $info->triangleBase;
		$triangleHeight = (int) $info->triangleHeight;

		global $functionsExecutedCounter;
		calculateSurfaceAreaRectangle($recSideA, $recSideB);
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
	case "e6":
		$json_response["sumResults"] = sumNumbers();
		break;
	case "m1":
		$json_response["dateTime"] = getDateTime();
		break;
	case "m2":
		$json_response["currentSeason"] = getCurrentSeason();
	case "m3":
		$inputValue = $info->inputValue;
		if (is_string($inputValue)) $json_response["returnValue"] = splitName($inputValue);
		if (is_array($inputValue)) $json_response["returnValue"] = combineNames($inputValue[0], $inputValue[1]);
		break;
	case "m4":
		$json_response["statesList"] = getStatesList();
		break;
	case "m5":
		$json_response["multiplesList"] = calculateMultiples();
		break;
	case "m6":
		$magicSentence = $info->magicSentence;
		$shuffleWord = $info->shuffleWord;
		$palindromeWord = $info->palindromeWord;
		$anagramWord = $info->anagramWord;
		$json_response["results"]["caseMagic"] = caseMagic($magicSentence);
		$json_response["results"]["shuffleWord"] = shuffleWord($shuffleWord);
		$json_response["results"]["isPalindrome"] = isPalindrome($palindromeWord[0]);
		$json_response["results"]["isAnagram"] = isAnagram($anagramWord[0], $anagramWord[1]);
		break;
	case "h1":
		$statesList = getStatesList();
		$json_response["statesList"] = shuffleArray($statesList);
		break;
	case "h2":
		$statesList = getStatesList();
		$letter = $info->letter;
		$json_response["statesList"] = removeArrayStringsWithoutSpecificLetter($statesList, $letter);
		break;
	case "h3":
		$statesList = getStatesList();
		$letter = $info->letter;
		$json_response["statesList"] = removeArrayStringsWithSpecificLetter($statesList, $letter);
		break;
	case "c1":
		$inputString = $info->inputString;
		$json_response["textToNumber"] = convertTextToNumber($inputString);
		break;
	case "c2":
		$limit = $info->limit;
		$json_response["fibonacciSequence"] = getFibonacciUpTo($limit);
		break;
	case "c3":
		$number = $info->number;
		$json_response["multipleOfTwo"] = multipleOfTwo($number);
		break;
	default:
		break;
}

// If all goes well, exit and send a JSON response
$json_response["serverMessage"] = "success";
exit(json_encode($json_response));
