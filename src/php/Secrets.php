<?php

namespace EnamelPinClub;

use \Exception;

class Secrets {
	/**
	 * @var null|string[]
	 */
	private static $data = null;

	/**
	 * @suppress PhanPartialTypeMismatchArgumentInternal,PhanTypeArraySuspiciousNullable
	 */
	public static function get(string $key = ""): string {
		if (self::$data === null) {
			self::$data = json_decode(file_get_contents(REAL_ROOTDIR . "secrets.json"), true);
		}

		if (self::$data === false || self::$data === null || !array_key_exists($key, self::$data)) {
			throw new Exception("secrets.json does not exist or does not contain {$key}");
		}

		return self::$data[$key];
	}
}
