<?php

session_start();

define("ROOTDIR", "");
define("REAL_ROOTDIR", "../");

require_once REAL_ROOTDIR . "src/php/initializer.php";

require_once REAL_ROOTDIR . "src/html/head.inc.php";
?>
	<body>
		<header>
			<div class="navbar-container">
				<a href="/"><span>Enamel Pin Club</span></a>
				<nav></nav>
			</div>
		</header>
		<main class="prose">
			<h1>Welcome!</h1>

			<p>Please join the <a href="https://telegram.dog/enamelpinclub">Telegram group</a> for updates – more to come soon!</p>
		</main>
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
