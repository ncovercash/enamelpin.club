<?php
use EnamelPinClub\Controller; ?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8" />

	<title>
		Home | Enamel Pin Club
	</title>

	<link rel="stylesheet" href="<?= ROOTDIR ?>styles.css" />

	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta name="keywords" content="enamel pin, pin, collection"/>
	<meta name="subject" content="enamel pin, pin, collection"/>
	<meta name="copyright" content="Noah Overcash"/>
	<meta name="language" content="EN"/>
	<meta name="robots" content="index,follow"/>
	<meta name="author" content="Noah Overcash <me@ncovercash.dev>"/>
	<meta name="designer" content="Noah Overcash <me@ncovercash.dev>"/>
	<meta name="reply-to" content="webmaster@enamelpin.club"/>
	<meta name="theme-color" content="#006064"/>

	<!-- Apple -->
	<meta name="apple-mobile-web-app-title" content="Enamel Pin Club"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<link href="tbd" rel="apple-touch-icon" type="image/png"/>
	<link href="tbd" rel="apple-touch-icon-precomposed" type="image/png"/>
	<link href="tbd" rel="apple-touch-icon" type="image/png"/>
	<link href="tbd" rel="apple-touch-icon-precomposed" type="image/png"/>
	<link rel="mask-icon" href="tbd" color="#006064"/>

	<!-- IE -->
	<meta name="msapplication-tooltip" content="Enamel Pin Club"/>
	<meta name="mssmarttagspreventparsing" content="true"/>
	<meta name="msapplication-starturl" content="https://enamelpin.club/"/>
	<meta name="msapplication-window" content="width=800;height=600"/>
	<meta name="msapplication-navbutton-color" content="#006064"/>

	<!-- win 8+ -->
	<meta name="application-name" content="Enamel Pin Club"/>
	<meta name="msapplication-TileColor" content="#006064"/>
	<meta name="msapplication-square70x70logo" content="tbd"/>

	<!-- opengraph -->
	<meta property="og:title" content="Home"/>
	<meta property="og:type" content="website"/>
	<meta property="og:url" content="<?= htmlspecialchars(Controller::getCanonicalRequestUrl()) ?>"/>
	<meta property="og:image" content="tbd"/>
	<meta property="og:image:url" content="tbd"/>
	<meta property="og:description" content="Please view this page in order to see the content."/>
	<meta property="og:site_name" content="Enamel Pin Club"/>
	<meta property="og:locale" content="en_US"/>

	<!-- twitter -->
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:site" content="https://enamelpin.club/" />
	<meta name="twitter:title" content="Home | Enamel Pin Club" />
	<meta name="twitter:description" content="Please view this page in order to see the content." />
	<meta property="twitter:image" content="tbd"/>

	<!-- link tags -->
	<link rel='shortcut icon' type='image/png' href='tbd'/>
	<link rel='fluid-icon' type='image/png' href='tbd'/>
	<link rel="canonical" href="https://enamelpin.club/"/>
	<link rel="image_src" href="tbd" type="image/png"/>

	<script type="text/javascript">
		window["ENAMEL_PIN_CLUB"] = {};
		<?php if (Controller::isDevelMode()): ?>
			window.ENAMEL_PIN_CLUB.debugMode = true;
			localStorage.debug = "*";
		<?php else: ?>
			window.ENAMEL_PIN_CLUB.debugMode = false;
		<?php endif; ?>
		window.ENAMEL_PIN_CLUB.isLoggedIn = <?= json_encode(array_key_exists("user", $_SESSION)) ?>;
		window.ENAMEL_PIN_CLUB.dark = <?= json_encode(
  	array_key_exists("user", $_SESSION) ? $_SESSION["user"]->isDarkModeEnabled() : true,
  ) ?>;
		window.ENAMEL_PIN_CLUB.root = <?= json_encode(ROOTDIR) ?>;
	</script>
</head>
