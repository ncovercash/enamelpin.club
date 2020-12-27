<?php

namespace EnamelPinClub\API;

use EnamelPinClub\HTTPCode;
use \InvalidArgumentException;

/**
 * Utility functions for an endpoint
 */
class Endpoint {
	/**
	 * If the currently accessed page is an endpoint
	 *
	 * @var bool
	 */
	static $isEndpoint = false;
	/**
	 * If the current page is an internal endpoint
	 *
	 * @var bool
	 */
	static $isInternalEndpoint = false;

	public const AUTH_REQUIRE_NONE = 0;
	public const AUTH_REQUIRE_LOGGED_IN = 1;
	public const AUTH_REQUIRE_LOGGED_OUT = 2;

	/**
	 * Ran for every endpoint
	 *
	 * @param bool $internal Used to denote an internal API endpoint, affects authentication
	 * @param int $internalAuth Type of authentication to require for an internal endpoint
	 */
	public static function init(
		bool $internal = false,
		int $internalAuth = self::AUTH_REQUIRE_LOGGED_IN
	): void {
		self::$isEndpoint = true;
		// ini_set('display_errors', 0); // don't pollute the JSON
		if (!$internal) {
			throw new InvalidArgumentException("Non-internal endpoints are not supported");
		} else {
			self::$isInternalEndpoint = true;
			switch ($internalAuth) {
				case 1:
					self::checkLoggedIn();
					break;
				case 2:
					self::checkLoggedOut();
					break;
				case 0:
					break; // none
				default:
					throw new InvalidArgumentException("Bad internal auth type specified");
			}
		}
	}

	/**
	 * Get if the current page is an API endpoint
	 *
	 * @return bool if the current page is an API endpoint
	 */
	public static function isEndpoint(): bool {
		return self::$isEndpoint;
	}

	/**
	 * Get if the current page is an internal API endpoint
	 *
	 * @return bool if the current page is an internal API endpoint
	 */
	public static function isInternalEndpoint(): bool {
		return self::$isInternalEndpoint;
	}

	/**
	 * Check if there is a user logged in.  Used for internal API calls.
	 */
	protected static function checkLoggedIn(): void {
		// if (!User::isLoggedIn()) {
		HTTPCode::set(401);
		Response::sendError("_global", "notLoggedIn");
		// }
	}

	/**
	 * Check if there is NOT a user logged in.  Used for internal API calls.
	 */
	protected static function checkLoggedOut(): void {
		// if (User::isLoggedIn()) {
		HTTPCode::set(401);
		Response::sendError("_global", "alreadyLoggedIn");
		// }
	}
}
