<?php
class Response {
    private ExitCode $exitCode;
    private array $additionalData = [];
    private array $errorList = [];
    private int $httpStatus = 200;

    public function __construct(
        ExitCode $exitCode,
        array $additionalData = [],
        array $errorList = []
    ) {
        $this->exitCode = $exitCode;
        $this->additionalData = $additionalData;
        $this->errorList = $errorList;
        // $this->httpStatus = $success ? 200 : 400;
    }

	public function setExitCode(ExitCode $exitCode): void {
        $this->exitCode = $exitCode;
	}

    public function getExitCode(): ExitCode {
        return $this->exitCode;
    }

    public function withAdditionalErrors(ErrorCode $key, ErrorCase|array $errorList): self {
        $clone = clone $this;

        // Validate error codes
        if (is_array($errorList)) {
            array_walk($errorList, function($code) {
                if (!$code instanceof ErrorCase) {
                    throw new InvalidArgumentException(
                        "All errors must be ErrorCode instances"
                    );
                }
            });

            $clone->errorList[$key->name] = array_merge(
                $clone->errorList[$key->name] ?? [], // Initialize if not exists
                $errorList
            );
        } else {
            $clone->errorList[$key->name] = $clone->errorList[$key->name] ?? []; // Initialize if not exists
            array_push($clone->errorList[$key->name], $errorList);
        }

        return $clone;
    }

    public function getErrorList(): array {
        return $this->errorList;
    }

    public function getAdditionalData(): array {
        return $this->additionalData;
    }

    public function withAdditionalData(string $key, $value): self {
        $clone = clone $this;
        $clone->additionalData[$key] = $value;
        return $clone;
    }

    public function toJson(): string {
        http_response_code($this->httpStatus);
        return json_encode($this->toArray());
    }

    public function toArray(): array {
        return [
            "exitCode" => ["name" => $this->exitCode->name, "message" => $this->exitCode->getDescription()],
            // "exitCode" => $this->exitCode,
            "additionalData" => $this->additionalData,
            "errorList" => $this->errorList,
        ];
    }

    public function __tostring(): string {
        return json_encode($this->toArray());
    }
}
