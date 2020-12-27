<?php

namespace EnamelPinClub\Database;

use EnamelPinClub\Database\Query\SelectQuery;

/**
 * A class which facilitates generation of (potentially unique) tokens
 */
class Tokens {
	// characters which nacan be made into tokens
	// [a-z0-9]
	public const TOKEN_CHARS = [
		"a",
		"b",
		"c",
		"d",
		"e",
		"f",
		"g",
		"h",
		"i",
		"j",
		"k",
		"l",
		"m",
		"n",
		"o",
		"p",
		"q",
		"r",
		"s",
		"t",
		"u",
		"v",
		"w",
		"x",
		"y",
		"z",
		"0",
		"1",
		"2",
		"3",
		"4",
		"5",
		"6",
		"7",
		"8",
		"9",
	];
	public const TOKEN_REGEX = '^[a-z0-9]*$';

	/**
	 * Generate a psuedorandom token
	 *
	 * This uses the Mersenne Twister algorithm (underlying for array_rand), which is secure enough
	 * and a psuedo-random enough number
	 * @param int $length
	 * @return string generated token
	 */
	public static function generateToken(int $length): string {
		return self::generateTokenFromCharset($length, self::TOKEN_CHARS);
	}

	/**
	 * Generate a psuedorandom token from a given list of characters
	 *
	 * This uses the Mersenne Twister algorithm (underlying for array_rand), which is secure enough
	 * and a psuedo-random enough number
	 * @param int $length
	 * @param string[] $chars
	 * @return string generated token
	 */
	public static function generateTokenFromCharset(int $length, array $chars): string {
		return str_shuffle(
			implode(
				"",
				/** @phan-suppress-next-line PhanUnusedClosureParameter */
				array_map(function (int $in) use ($chars) {
					return $chars[array_rand($chars)];
				}, range(1, $length)),
			),
		);
	}

	/**
	 * Get an array of in-use tokens from the database
	 *
	 * @param string $table Database table
	 * @param string $column Database column which holds tokens
	 * @return string[] Tokens currently in use
	 */
	public static function getTokensFromDatabase(string $table, string $column): array {
		$stmt = new SelectQuery();

		$stmt->setTable($table);
		$stmt->addColumn(new Column($column, $table));

		$stmt->execute();

		return array_column($stmt->getResult(), $column);
	}

	/**
	 * Get a unique token with a given length and database column/table
	 *
	 * @param int $length Token length
	 * @param string $table Table
	 * @param string $column Column
	 * @return string Unique token
	 */
	public static function generateUniqueToken(int $length, string $table, string $column): string {
		$existingTokens = self::getTokensFromDatabase($table, $column);

		$token = self::generateToken($length);

		while (in_array($token, $existingTokens, true)) {
			$token = self::generateToken($length);
		}

		return $token;
	}
}
