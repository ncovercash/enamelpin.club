<?php

session_start();

define("ROOTDIR", "");
define("REAL_ROOTDIR", "../");

require_once REAL_ROOTDIR . "src/php/initializer.php";

require_once REAL_ROOTDIR . "src/html/head.inc.php";
?>
	<body class="dark">
		<header>
			<div class="navbar-container">
				<a href="/"><span>Enamel Pin Club</span></a>
				<nav></nav>
			</div>
		</header>
		<h1>Something should go here sometime.</h1>
		<footer>
			<div>
				<a href="/"><span>Enamel Pin Club</span></a>
				<p class="copyright">&copy;2020-<?= date(
    	"Y",
    ) ?> <a href="https://ncovercash.dev/">Noah Overcash</a></p>
			</div>
		</footer>
	</body>
<?php require_once REAL_ROOTDIR . "src/html/closing.inc.php";
