<?php

namespace EnamelPinClub\API;

use \EnamelPinClub\{Controller, HTTPCode};
use EnamelPinClub\Database\Database;
use EnamelPinClub\Database\Query\AbstractQuery;
use EnamelPinClub\Page\UniversalFunctions;

/**
 * Contains various utilities to standardize JSON responses
 */
class Response {
	/**
	 * Return a success response
	 *
	 * @param string $message Message which describes the response
	 * @param mixed[] $data Additional data
	 */
	public static function sendSuccess(string $message, array $data = []): void {
		if (HTTPCode::get() > 400) {
			HTTPCode::set(200);
		}
		echo json_encode(
			[
				"error" => false,
				"http_code" => HTTPCode::get(),
				"message" => $message,
				"data" => $data,
				"_debug" => Controller::isDevelMode()
					? [
						"_commit" => Controller::getCommit(),
						"_time" => microtime(true) - EXEC_START_TIME,
						"_queries" => AbstractQuery::getTotalQueries(),
						"_query_time" => Database::getTotalQueryTime(),
						"_memory" => memory_get_peak_usage(),
					]
					: "[REDACTED]",
			],
			Controller::isDevelMode() ? JSON_PRETTY_PRINT : 0,
		);
		if (Endpoint::isEndpoint() && !Endpoint::isInternalEndpoint()) {
			$_SESSION = [];
		}
		die();
	}

	/**
	 * Return an error response
	 *
	 * @param string $location Distinguisher of the form-field or other location type
	 * @param string $errorType Type of error
	 * @param mixed[] $data Additional data
	 */
	public static function sendError(string $location, string $errorType, array $data = []): void {
		if (HTTPCode::get() < 300) {
			HTTPCode::set(400);
		}
		echo json_encode(
			[
				"error" => true,
				"http_code" => HTTPCode::get(),
				"error_location" => $location,
				"error_type" => $errorType,
				"data" => $data,
				"_debug" => Controller::isDevelMode()
					? [
						"_trace" => Controller::getTrace(true),
						"_get" => $_GET,
						"_post" => $_POST,
						"_files" => $_FILES,
						"_session" => $_SESSION,
						"_commit" => Controller::getCommit(),
						"_time" => microtime(true) - EXEC_START_TIME,
						"_queries" => AbstractQuery::getTotalQueries(),
						"_query_time" => Database::getTotalQueryTime(),
						"_memory" => memory_get_peak_usage(),
					]
					: "[REDACTED]",
			],
			Controller::isDevelMode() ? JSON_PRETTY_PRINT : 0,
		);
		if (Endpoint::isEndpoint() && !Endpoint::isInternalEndpoint()) {
			$_SESSION = [];
			trigger_error(
				"API Error RESPONSE given: " .
					$location .
					" " .
					$errorType .
					" " .
					serialize($data),
			);
		}
		die();
	}
}
