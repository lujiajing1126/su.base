<?php

if (preg_match('/\.(?:php)$/', $_SERVER["REQUEST_URI"])) {
	include substr($_SERVER["DOCUMENT_ROOT"], 0, -4) . '.prog/siteconf.php';
}

return false;
