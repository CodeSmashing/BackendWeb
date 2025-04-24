<?php
header("Content-Type: application/json");

set_exception_handler(function (Throwable $e) {
	error_log("Uncaught exception: " . $e->getMessage(), 0);
	http_response_code(500);
	echo json_encode(["error" => "An unexpected error occurred. Please try again later."]);
});

define("PI", 3.1415);
$json_response = [];
$straal = (int) $_POST["straal"];

function berekenOppervlakteCirkel($straal): float {
	$oppervlakte = PI * $straal * $straal;
	return $oppervlakte;
}

// If all goes well, exit and send a JSON response
$json_response["result"] = berekenOppervlakteCirkel($straal);
exit(json_encode($json_response));
