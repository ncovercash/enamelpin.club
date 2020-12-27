<?php

define("EXEC_START_TIME", microtime(true));

require_once __DIR__ . DIRECTORY_SEPARATOR . "Controller.php";

spl_autoload_register("\\EnamelPinClub\\Controller::loadClass");

use EnamelPinClub\Images\Image;
use EnamelPinClub\Organization\Organization;
use \EnamelPinClub\{Controller, Values};

// Choose what error handling we want to do
if (Controller::isDevelMode()) {
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	ini_set("display_startup_errors", 1);
	ini_set("scream.enabled", 1);
} else {
	error_reporting(0);
	ini_set("display_errors", 0);
	ini_set("display_startup_errors", 0);
	ini_set("scream.enabled", 0);
}

if (php_sapi_name() !== "cli") {
	ob_start();

	header("X-Version: " . Controller::getVersion() . " (" . Controller::getCommit() . ")", true);
}

register_shutdown_function("\\EnamelPinClub\\Controller::shutdown");
set_error_handler("\\EnamelPinClub\\Controller::handleError", E_ALL);
set_exception_handler("\\EnamelPinClub\\Controller::handleException");

require_once __DIR__ . "/vendor/autoload.php";

if (!session_id() && !defined("NO_SESSION")) {
	ini_set("session.name", "enamel-pin-club");
	ini_set("session.gc_maxlifetime", 24 * 60 * 60);
	ini_set("session.cookie_lifetime", 24 * 60 * 60);
	ini_set("session.cookie_httponly", 1);
	ini_set("session.cookie_secure", 1);
	session_start([
		"name" => "EnamelPinClub",
		"gc_maxlifetime" => 24 * 60 * 60,
		"cookie_lifetime" => 24 * 60 * 60,
		"cookie_httponly" => true,
		"cookie_secure" => true,
	]);
}

date_default_timezone_set("America/New_York");
