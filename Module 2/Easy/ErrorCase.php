<?php
// Describes the specific instance (e.g., "missing assignment", "invalid pattern")
enum ErrorCase: string {
    case MISSING_ASSIGNMENT = "missing-assignment";
    case MISSING_ACTION = "missing-action";
    case MISSING_INFO = "missing-info";
    case MISSING_FORM_INFO = "missing-form-info";
    case MISSING_USERNAME = "missing-username";
    case MISSING_PASSWORD = "missing-password";
    case NOT_STRING = "not-string";
    case NOT_INTEGER = "not-integer";
    case INVALID_REQUEST_METHOD = "invalid-request-method";
    case INVALID_PATTERN = "invalid-pattern";
    case INVALID_PATTERN_USERNAME = "invalid-pattern-username";
    case INVALID_PATTERN_PASSWORD = "invalid-pattern-password";
    case LENGTH_TOO_SHORT = "length-short";
    case LENGTH_TOO_LONG = "length-long";

    public function getDescription(): string {
        try {
            return match ($this) {
                self::MISSING_ASSIGNMENT => "Assignment ID not provided",
                self::MISSING_ACTION => "Action string not provided",
                self::MISSING_INFO => "Info object not provided",
                self::MISSING_FORM_INFO => "Form body not provided",
                self::MISSING_USERNAME => "Username not provided",
                self::MISSING_PASSWORD => "Password not provided",
                self::NOT_STRING => "Type isn't string",
                self::NOT_INTEGER => "Type isn't integer",
                self::INVALID_REQUEST_METHOD => "Unsupported HTTP method",
                self::INVALID_PATTERN => "Value fails pattern requirements",
                self::INVALID_PATTERN_USERNAME => "Username fails pattern requirements",
                self::INVALID_PATTERN_PASSWORD => "Password fails pattern requirements",
                self::LENGTH_TOO_SHORT => "Value length is too short",
                self::LENGTH_TOO_LONG => "Value length is too long",
                default => throw new LogicException("Missing description for: " . $this->name)
            };
        } catch (\Error $e) {
            error_log("Missing exit code description: " . $this->name);
            return "Unknown status";
        }
    }
}
