<?php
define(BUILD_MODE, "---BUILD_MODE---");

$_SITE = array();

$_SITE['prog'] = rtrim(__DIR__, DIRECTORY_SEPARATOR);

if (substr($_SITE['prog'], -5) == '.prog')
	$_SITE['ref'] = substr($_SITE['prog'], 0, -5);
else
	$_SITE['ref'] = $_SITE['prog'];

$_SITE['doc'] = $_SITE['ref'] . '.doc';

/*
$_SITE['doc'] = rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR);

if (substr($_SITE['doc'], -4) == '.doc')
	$_SITE['ref'] = substr($_SITE['doc'], 0, -4);
else
	$_SITE['ref'] = $_SITE['doc'];

$_SITE['prog'] = $_SITE['ref'] . '.prog';
*/

$_SITE['var'] = $_SITE['ref'] . '.var';
$_SITE['conf'] = $_SITE['ref'] . '.conf';

$_SITE['clientlib'] = $_SITE['doc'] . DIRECTORY_SEPARATOR . 'lib';

$_SITE['cache'] = $_SITE['var'] . DIRECTORY_SEPARATOR . 'cache';
$_SITE['userdata'] = $_SITE['var'] . DIRECTORY_SEPARATOR . 'data';

$_SITE['phplib'] = $_SITE['prog'] . DIRECTORY_SEPARATOR . 'phplib';

set_include_path($_SITE['phplib'] . PATH_SEPARATOR . get_include_path());
