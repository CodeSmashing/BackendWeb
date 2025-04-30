<?php
function validateUserInfo($username, $password) {
	$responseObj = new stdClass();

	if (empty($username) || empty($password)) {
		$field = empty($username) ? "username" : "password";
		$responseObj->success = false;
		$responseObj->exitReason = "empty-$field";
		$responseObj->serverMessage = "No $field provided.";
		return $responseObj;
	}

	// Filter options
	$usernameOptions = [
		"options" => [
			"regexp" => "/^[a-zA-Z0-9_]+$/"
		]
	];

	$passwordOptions = [
		"options" => [
        	"regexp" => "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,64}$/"
		]
	];

	// Prepare for comparisons
	$username = trim(filter_var($username, FILTER_VALIDATE_REGEXP, $usernameOptions));
	$password = trim(filter_var($password, FILTER_VALIDATE_REGEXP, $passwordOptions));

	if (!$username || !$password) {
		$field = empty($username) ? "username" : "password";
		$responseObj->success = false;
		$responseObj->exitReason = "invalid-$field";
		$responseObj->serverMessage = ($field == "username") ?
		"Username must contain only letters, numbers, and underscores." :
		"Password must be 8–64 characters long and may include letters, numbers, underscores, and these special characters: !@#$%^&*";
		return $responseObj;
	}

	$responseObj->success = true;
	$responseObj->exitReason = "input-validated";
	$responseObj->serverMessage = "Successfully validated user input.";
	$responseObj->hash = password_hash($password, PASSWORD_DEFAULT);
	return $responseObj;
}
