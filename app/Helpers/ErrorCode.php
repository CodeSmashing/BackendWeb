<?php

namespace App\Helpers;

use LogicException;

// Describes the type/category of error (e.g., "missing value", "invalid type")
enum ErrorCode: string {
    case MISSING_VALUE = "missing-value";
    case INVALID_VALUE = "invalid-value";
    case INVALID_TYPE = "invalid-type";
    case INCORRECT_LENGTH = "incorrect-length";
    case SERVER_ERROR = "server-error";

    public function getDescription(): string {
        try {
            return match ($this) {
                self::MISSING_VALUE => "Value is not provided",
                self::INVALID_VALUE => "Value is invalid",
                self::INVALID_TYPE => "Value is of invalid type",
                self::INCORRECT_LENGTH => "Value is of an incorrect length",
                self::SERVER_ERROR => "Internal server error",
                default => throw new LogicException("Missing description for: " . $this->name)
            };
        } catch (\Error $e) {
            error_log("Missing exit code description: " . $this->name);
            return "Unknown status";
        }
    }
}
