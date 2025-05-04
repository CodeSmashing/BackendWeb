<?php

namespace App\Helpers;

use LogicException;

enum ExitCode: string {
    case REQUEST_SUCCESS = "request-success";
    case REQUEST_FAILURE = "request-failure";
    case VALIDATION_SUCCESS = "validation-success";
    case VALIDATION_FAILURE = "validation-failure";

    public function getDescription(): string {
        try {
            return match ($this) {
                self::REQUEST_SUCCESS => "Request processed successfully",
                self::REQUEST_FAILURE => "Request failed",
                self::VALIDATION_SUCCESS => "Validation processed successfully",
                self::VALIDATION_FAILURE => "Validation failed",
                default => throw new LogicException("Missing description for: " . $this->name)
            };
        } catch (\Error $e) {
            error_log("Missing exit code description: " . $this->name);
            return "Unknown status";
        }
    }
}
