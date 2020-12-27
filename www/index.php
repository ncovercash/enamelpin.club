<?php

session_start();

define("ROOTDIR", "");
define("REAL_ROOTDIR", "../");

require_once REAL_ROOTDIR . "src/php/initializer.php";

require_once REAL_ROOTDIR . "src/html/head.inc.php";
?>
	<h1>Test!</h1>
<?php require_once REAL_ROOTDIR . "src/html/footer.inc.php";
