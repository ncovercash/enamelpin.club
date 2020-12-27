<?php

namespace EnamelPinClub\Database;

use \EnamelPinClub\{Controller, Secrets};
use \PDO;
use \PDOStatement;
use \RuntimeException;

/**
 * Contains the database handler and DB connection info
 *
 * Is only used for that, nothing else.  Constants are for connection info, public because may be used elsewhere
 */
class Database {
	public const DB_DRIVER = "mysql";
	public const DB_SERVER = "enamelpin.club";
	public const DB_PORT = 3306;
	public const DB_NAME = "pinclub";
	public const DB_USER = "pinclub";

	/**
	 * Contains the PDO instance for our database
	 * Should be accessed through ::getDbh so we can make sure its initialized
	 *
	 * @var PDO
	 */
	protected static $dbh = null;

	/**
	 * Initializes database handler
	 */
	protected static function init(): void {
		// don't reinitialize
		if (self::$dbh instanceof PDO) {
			return;
		}
		self::$dbh = new PDO(self::getDataSourceName(), self::DB_USER, Secrets::get("DB_PASSWORD"));

		foreach (self::getPdoAttributes() as $attr => $value) {
			self::$dbh->setAttribute($attr, $value);
		}

		if (Controller::isDevelMode()) {
			self::$dbh->query("set profiling=1");
		}
	}

	/**
	 * Get the DNS for PDO
	 *
	 * @return string
	 */
	public static function getDataSourceName(): string {
		return self::DB_DRIVER .
			":" .
			"host=" .
			self::DB_SERVER .
			";" .
			"port=" .
			self::DB_PORT .
			";" .
			"dbname=" .
			self::DB_NAME .
			";" .
			"charset=utf8mb4";
	}

	/**
	 * Get attributes to apply to PDO connections
	 *
	 * @return int[]
	 */
	public static function getPdoAttributes(): array {
		return [
			// properly raise errors
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			// return as column => value,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		];
	}

	/**
	 * Get the database handler
	 *
	 * @return \PDO database handler
	 */
	public static function getDbh(): PDO {
		if (!(self::$dbh instanceof PDO)) {
			self::init();
		}
		return self::$dbh;
	}

	public static function prepare(string $sql): PDOStatement {
		$stmt = self::$dbh->query($sql);
		if ($stmt === false) {
			throw new RuntimeException("Could not prepare statement {$sql}");
		}
		return $stmt;
	}

	public static function getTotalQueryTime(): float {
		$stmt = self::getDbh()->query("show profiles");
		if ($stmt === false) {
			throw new RuntimeException("Unable to calculate SQL debug information.");
		}
		$rows = $stmt->fetchAll();
		if ($rows === false) {
			throw new RuntimeException("Unable to calculate SQL debug information.");
		}
		return array_sum(array_column($rows, "Duration"));
	}
}
