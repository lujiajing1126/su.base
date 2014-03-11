<?php

if (preg_match('/\.(?:php)$/', $_SERVER["SCRIPT_FILENAME"])) {
	include substr($_SERVER["DOCUMENT_ROOT"], 0, -4) . '.prog/siteconf.php';
}

return false;
