<?php

namespace EnamelPinClub\Database\Query;

use EnamelPinClub\Database\Database;
use EnamelPinClub\Database\QueryAddition\{JoinClause, WhereClause};
use EnamelPinClub\HTTPCode;
use \InvalidArgumentException;

/**
 * Represents a MySQL UPDATE query
 */
class UpdateQuery extends AbstractQuery {
	/**
	 * Adds additional check for a WHERE clause as this is a destructive query
	 * (And i've made this mistake one too many times ffs)
	 */
	protected function verifyIntegrity(): bool {
		parent::verifyIntegrity();

		foreach ($this->additionalCapabilities as $additionalCapability) {
			if ($additionalCapability instanceof WhereClause) {
				return true;
			}
		}

		throw new InvalidArgumentException(
			"No WhereClause given to limit UpdateQuery, which could be potentially disastrous.  Refusing to permit query execution.",
		);
	}

	/**
	 * Executes the query
	 *
	 * Bind columns and whatnot. Also fills in ? for PDO binding
	 *
	 * @return bool if the query was successful
	 */
	public function execute(): bool {
		$this->verifyIntegrity();

		$initialQuery = "UPDATE `" . $this->table . "` ";

		// join clauses go up here!
		if (is_array($this->additionalCapabilities)) {
			foreach ($this->additionalCapabilities as $additionalCapability) {
				if ($additionalCapability instanceof JoinClause) {
					$initialQuery .= $additionalCapability->getQueryString();
					$initialQuery .= " ";
				}
			}
		}

		$initialQuery .= " SET " . implode(" = ?, ", $this->columns) . " = ? ";

		// additional
		if (is_array($this->additionalCapabilities)) {
			foreach ($this->additionalCapabilities as $additionalCapability) {
				if ($additionalCapability instanceof JoinClause) {
					continue;
				}
				// each additional capability should verify integrity in its getQueryString
				$initialQuery .= $additionalCapability->getQueryString();
			}
		}
		$initialQuery .= ";";

		$stmt = Database::prepare($initialQuery);

		$stmt->execute($this->getParamtersToBind());

		$this->result = (int) Database::getDbh()->lastInsertId();

		self::$totalQueries++;

		return true;
	}
}
