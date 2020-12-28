<?php

session_start();

define("ROOTDIR", "");
define("REAL_ROOTDIR", "../");

require_once REAL_ROOTDIR . "src/php/initializer.php";

require_once REAL_ROOTDIR . "src/html/head.inc.php";
?>
	<!-- This demo uses float grid but you can use flex grid too -->

	<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
	  <button class="menu-icon" type="button" data-toggle="example-menu"></button>
	  <div class="title-bar-title">Menu</div>
	</div>

	<div class="top-bar" id="example-menu">
	  <div class="top-bar-left">
	    <ul class="dropdown menu" data-dropdown-menu>
	      <li class="menu-text">Site Title</li>
	      <li class="has-submenu">
	        <a href="#0">One</a>
	        <ul class="submenu menu vertical" data-submenu>
	          <li><a href="#0">One</a></li>
	          <li><a href="#0">Two</a></li>
	          <li><a href="#0">Three</a></li>
	        </ul>
	      </li>
	      <li><a href="#0">Two</a></li>
	      <li><a href="#0">Three</a></li>
	    </ul>
	  </div>
	  <div class="top-bar-right">
	    <ul class="menu">
	      <li><input type="search" placeholder="Search"></li>
	      <li><button type="button" class="button">Search</button></li>
	    </ul>
	  </div>
	</div>

	<div class="row demo-toggle-title">
	  <div class="columns">
	    <h2>Topbar with Responsive Toggle</h2>
	    <p>In the above example, we've combined the above pattern with the Responsive Toggler plugin, creating a responsive top bar with a toggle click trigger on mobile.</p>
	    <div class="primary callout show-for-medium">
	      <p>Scale your browser down to see the toggle happen.</p>
	    </div>
	  </div>
	</div>

<?php require_once REAL_ROOTDIR . "src/html/footer.inc.php";
