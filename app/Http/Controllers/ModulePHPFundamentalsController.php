<?php

namespace App\Http\Controllers;

class ModulePHPFundamentalsController extends Controller
{
	private static $PI = define("PI", 3.1415);
	public static $functionsExecutedCounter = 0;

	public static function calculateSurfaceAreaCirkel($radius): float {
		global $functionsExecutedCounter;
		$functionsExecutedCounter++;
		$surfaceArea = PI * $radius * $radius;
		return $surfaceArea;
	}

	public static function calculateSurfaceAreaRectangle($side1, $side2): float {
		global $functionsExecutedCounter;
		$functionsExecutedCounter++;
		return $side1 * $side2;
	}

	public static function calculateSurfaceAreaSquare($side): float {
		global $functionsExecutedCounter;
		$functionsExecutedCounter++;
		return ModulePHPFundamentalsController::calculateSurfaceAreaRectangle($side, $side);
	}

	public static function calculateSurfaceAreaTriangle($base, $height): float {
		global $functionsExecutedCounter;
		$functionsExecutedCounter++;
		return $base * $height / 2;
	}

	public static function variabelTest(): array {
		$variabel1 = "";
		$variabel2 = null;
		$variabel3 = [];
		$variabel4 = [1, 2, 3];
		$variabel5 = "test";
		$returnArray = [];

		$returnArray["variabel1"] = isset($variabel1);
		$returnArray["variabel2"] = isset($variabel2);
		$returnArray["variabel3"] = empty($variabel3);
		$returnArray["variabel4"] = empty($variabel4);
		$returnArray["variabel5"] = [isset($variabel5), empty($variabel5)];

		return $returnArray;
	}

	public static function checkRandomNumber(): array {
		$counter = 0;
		$returnArray = [];

		while ($counter != 100) {
			$randomNumber = rand(1, 100);
			if (in_array($randomNumber, [10, 20, 30])) {
				array_push($returnArray, "Het nummer is gelijk aan $randomNumber");
			} else {
				array_push($returnArray, "Het nummer was niet wat we zochten");
			}
			$counter++;
		}

		return $returnArray;
	}

	public static function sumNumbers() {
		$counter = 1;
		$returnResult = 0;

		while ($counter <= 30) {
			$returnResult += $counter++;
		}

		return $returnResult;
	}

	public static function getDateTime(): array {
		$returnArray = [];

		$returnArray["date"] = date("Y-m-d");
		$returnArray["dateTime"] = date("d/m/y h:m:s");
		$returnArray["dateTimeFull"] = date("l d/m/Y, h:m:s");

		return $returnArray;
	}

	public static function getCurrentSeason() {
		$month = (int) date("m");
		if ($month == 12 || $month <= 2) return "Winter";
		if ($month >= 3 || $month <= 5) return "Lente";
		if ($month >= 6 && $month <= 8) return "Zomer";
		if ($month >= 9 && $month <= 11) return "Herfst";
	}

	public static function splitName($name): array|string {
		if (!str_contains($name, " ")) return "Error: Name must contain a space.";

		$name = explode(" ", $name, 2);
		$firstName = $name[0];
		$lastName = $name[1];
		return [$firstName, $lastName];
	}

	public static function combineNames($firstName, $lastName): string {
		$fullname = "$firstName $lastName";
		return $fullname;
	}

	public static function getStatesList(): array {
		$statesList = ["België", "Denmark", "Frankrijk", "Slovakije", "Portugal", "Griekenland", "Finland", "Italië", "Roemenië"];
		sort($statesList);
		return $statesList;
	}

	public static function calculateMultiples(): array {
		$highestMultiple = 6;
		$multipleLimit = 6;
		$returnArray = array_fill(0, $highestMultiple, []);

		for ($i = 1; $i <= $highestMultiple; $i++) {
			for ($j = 1; $j <= $multipleLimit; $j++) {
				$returnArray[$i - 1][$j - 1] = "$j*$i = " . $j * $i;
			}
		}

		return $returnArray;
	}

	public static function caseMagic($sentence): array {
		$returnArray = [];

		$returnArray["case1"] = strtoupper($sentence);
		$returnArray["case2"] = strtolower($sentence);
		$returnArray["case3"] = ucfirst($sentence);
		$returnArray["case4"] = ucfirst($sentence);
		$returnArray["case5"] = ucwords($sentence);
		return $returnArray;
	}

	public static function shuffleWord($word): string {
		$shuffledWord = str_shuffle($word);
		return $shuffledWord;
	}

	public static function isPalindrome($word1): bool {
		$returnBool = (strtolower($word1) == strrev(strtolower($word1))) ? true: false;
		return $returnBool;
	}

	public static function isAnagram($word1, $word2): bool {
		$word1 = strtolower(str_replace(" ", "", $word1));
		$word2 = strtolower(str_replace(" ", "", $word2));
		$returnBool = (count_chars($word1, 1) == count_chars($word2, 1)) ? true : false;
		return $returnBool;
	}

	public static function shuffleArray($array) {
		shuffle($array);
		return $array;
	}

	public static function removeArrayStringsWithoutSpecificLetter($array, $letter): array {
		$filtered = array_filter($array, function($item) use ($letter) {
			return strtolower($item)[0] == $letter ? true : false;
		});
		return array_values($filtered);
	}

	public static function removeArrayStringsWithSpecificLetter($array, $letter): array {
		$filtered = array_filter($array, function($item) use ($letter) {
			return strtolower($item)[0] == $letter ? false : true;
		});
		return array_values($filtered);
	}

	public static function convertTextToNumber($text): int {
		$returnNumber = 0;
		$textArray = explode(";", $text);
		$textNumericValue = [
			"nul" => 0,
			"een" => 1,
			"twee" => 2,
			"drie" => 3,
			"vier" => 4,
			"vijf" => 5,
			"zes" => 6,
			"zeven" => 7,
			"acht" => 8,
			"negen" => 9
		];
		foreach ($textArray as $key) {
			$returnNumber = $returnNumber * 10 + $textNumericValue[$key];
		}

		return $returnNumber;
	}

	public static function getFibonacciUpTo($limit): array  {
		$returnArray = [0, 1];

		for ($i = 2; $i < $limit; $i++) {
			$returnArray[$i] = $returnArray[$i - 2] + $returnArray[$i - 1];
		}
		return $returnArray;
	}

	public static function multipleOfTwo($number) {
		$isMultiple = $number % 2;
		$returnArray = [
			"isMultiple" => null,
			"power" => null
		];

		$log = log($number, 2);
		$returnArray["isMultiple"] = $isMultiple == 0 ? true : false;
		$returnArray["power"] = is_int($log) ? $log : round($log);
		return $returnArray;
	}
}
