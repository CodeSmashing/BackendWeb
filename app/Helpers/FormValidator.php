<?php

namespace App\Helpers;

use stdClass;

class FormValidator {
    protected static array $ruleSetList = [
        "username" => [
            "type" => "string",
            "required" => true,
            "regex" => "/^[a-zA-Z0-9_]{4,25}$/",
            "min_length" => 4,
            "max_length" => 25
        ],
        "password" => [
            "type" => "string",
            "required" => true,
            "regex" => "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,64}$/",
            "min_length" => 8,
            "max_length" => 64,
        ],
        "country" => [
            "type" => "string",
            "required" => false,
            "regex" => "/^[A-Za-zÀ-ÿ\s\-']{2,40}$/",
            "min_length" => 2,
            "max_length" => 40
        ],
    ];

    /**
     * Validates a form based on predefined rules.
     *
     * @param array $inputList A list of input values to validate.
     * @return stdClass An object of error message lists, or an object with empty error message lists.
     */
    public static function validateForm(stdClass $inputList): stdClass {
        $errorList = new stdClass();

        foreach ($inputList as $field => $value) {
            $errorList->$field = new stdClass();

            FormValidator::validateField(
                $errorList->$field,
                $field,
                $value,
                FormValidator::$ruleSetList[$field]
            );
        }

        return $errorList;
    }

    /**
     * Validates a field based on predefined rules.
     *
     * @param stdClass $fieldErrorList An object of (empty) error message lists.
     * @param string $field The input field's name.
     * @param mixed $value The input value to validate.
     * @param array $ruleSet The predefined rules.
     * @return void
     */
    protected static function validateField(stdClass $fieldErrorList, string $field, $value, array $ruleSet): void {
        // Check if the value is set
        if (isset($ruleSet["required"])) {
            if ($ruleSet["required"] === true) {
                if ($value === null || empty(trim($value))) {
                    $errorCode = ErrorCode::MISSING_VALUE->value;
                    FormValidator::pushErrorCase($fieldErrorList, $errorCode, ErrorCase::from("missing-$field"));
                    return;
                }
            }
        }

        // Check if the value is of the correct type
        if (isset($ruleSet["type"])) {
            if ($ruleSet["required"] === true || ($value !== null && empty(trim($value)) !== false)) {
                $errorCode = ErrorCode::INVALID_TYPE->value;

                switch ($ruleSet["type"]) {
                    case "string":
                        if (!is_string($value)) {
                            FormValidator::pushErrorCase($fieldErrorList, $errorCode, ErrorCase::NOT_STRING);
                        }
                        break;
                    case "int":
                        if (!is_integer($value)) {
                            FormValidator::pushErrorCase($fieldErrorList, $errorCode, ErrorCase::NOT_INTEGER);
                        }
                        break;
                    default:
                        break;
                }
            }
        }

        // Check if the value meets the minimum length requirement
        if (isset($ruleSet["min_length"]) && isset($ruleSet["max_length"])) {
            if ($ruleSet["required"] === true || ($value !== null && empty(trim($value)) !== false)) {
                $length = strlen($value);

                if ($length < $ruleSet["min_length"]) {
                    $errorCode = ErrorCode::INCORRECT_LENGTH->value;
                    FormValidator::pushErrorCase($fieldErrorList, $errorCode, ErrorCase::LENGTH_TOO_SHORT);
                } elseif ($length > $ruleSet["max_length"]) {
                    $errorCode = ErrorCode::INCORRECT_LENGTH->value;
                    FormValidator::pushErrorCase($fieldErrorList, $errorCode, ErrorCase::LENGTH_TOO_LONG);
                }
            }
        }

        // Check if the value matches the regular expression
        if (isset($ruleSet["regex"])) {
            if ($ruleSet["required"] === true || ($value !== null && empty(trim($value)) !== false)) {
                if (!preg_match($ruleSet["regex"], $value)) {
                    $errorCode = ErrorCode::INVALID_VALUE->value;
                    FormValidator::pushErrorCase($fieldErrorList, $errorCode, ErrorCase::from("invalid-pattern-$field"));
                }
            }
        }
    }

    /**
     * Push a specific ErrorCase under a specific ErrorCode.
     *
     * @param stdClass $fieldErrorList An object of (empty) error message lists.
     * @param string $errorCode Specific ErrorCode string value.
     * @param ErrorCase $case Specific ErrorCase object.
     * @return void
     */
    protected static function pushErrorCase(stdClass $fieldErrorList, string $errorCode, ErrorCase $case): void {
        $fieldErrorList->$errorCode = $fieldErrorList->$errorCode ?? [];
        array_push($fieldErrorList->$errorCode, $case);
    }
}
