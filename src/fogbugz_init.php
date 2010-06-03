<?php

require_once 'fogbugz.php';
require_once 'fogbugz_request.php';
require_once 'fogbugz_response.php';
require_once 'fogbugz_exception.php';

// reponse classes bulk import
$response_classes = array(
	'error',
	'empty',
	'api',
	'token',
	'filters',
	'filter',
	'cases',
	'case'
);
foreach($response_classes as $response_class) {
	require_once(sprintf("fogbugz_response_%s.php",$response_class));
}

// clean up pointless globals
unset($response_classes);
?>
