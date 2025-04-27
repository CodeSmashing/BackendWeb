<?php
function caseMagic($sentence): array {
	$returnArray = [];

	$returnArray["case1"] = strtoupper($sentence);
	$returnArray["case2"] = strtolower($sentence);
	$returnArray["case3"] = ucfirst($sentence);
	$returnArray["case4"] = ucfirst($sentence);
	$returnArray["case5"] = ucwords($sentence);
	return $returnArray;
}

function shuffleWord($word): string {
	$shuffledWord = str_shuffle($word);
	return $shuffledWord;
}

function isPalindrome($word1): bool {
	$returnBool = (strtolower($word1) == strrev(strtolower($word1))) ? true: false;
	return $returnBool;
}

function isAnagram($word1, $word2): bool {
	$word1 = strtolower(str_replace(" ", "", $word1));
	$word2 = strtolower(str_replace(" ", "", $word2));
	$returnBool = (count_chars($word1, 1) == count_chars($word2, 1)) ? true : false;
	return $returnBool;
}
