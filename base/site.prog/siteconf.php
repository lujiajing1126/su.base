<?php
$_SITE = array(
	'doc' => rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR)
);

if (substr($_SITE['doc'], -4) == '.doc')
	$_SITE['ref'] = substr($_SITE['doc'], 0, -4);
else
	$_SITE['ref'] = $_SITE['doc'];

$_SITE['var'] = $_SITE['ref'] . '.var';
$_SITE['prog'] = $_SITE['ref'] . '.prog';

$_SITE['clientlib'] = $_SITE['doc'] . '/lib';

$_SITE['cache'] = $_SITE['var'] . '/cache';
$_SITE['userdata'] = $_SITE['var'] . '/data';

$_SITE['phplib'] = $_SITE['prog'] . '/phplib';

set_include_path($_SITE['phplib'] . PATH_SEPARATOR . get_include_path());
