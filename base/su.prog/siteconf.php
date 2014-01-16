<?php
$_SITE = array(
	'root' => rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR)
);

$_SITE['var'] = $_SITE['root'] . '.var';
$_SITE['prog'] = $_SITE['root'] . '.prog';

$_SITE['clientlib'] = $_SITE['root'] . '/lib';

$_SITE['cache'] = $_SITE['var'] . '/cache';
$_SITE['userdata'] = $_SITE['var'] . '/data';

$_SITE['phplib'] = $_SITE['prog'] . '/phplib';

set_include_path($_SITE['phplib'] . PATH_SEPARATOR . get_include_path());
