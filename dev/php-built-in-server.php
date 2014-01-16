<?php

if (preg_match('/\.(?:php)$/', $_SERVER["REQUEST_URI"])) {
	include __DIR__ . '/../su.prog/siteconf.php';
}

return false;
