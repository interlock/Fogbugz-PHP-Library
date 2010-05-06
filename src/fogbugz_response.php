<?php

class FogBugz_Response {

	var $_document = null;
	
	static $reponse_mappings = array(
		'//response/version' => 'FogBugz_Response_Api',
		'//response/token' => 'FogBugz_Response_Token',
		'//response/filters' => 'FogBugz_Response_Filters',
		'//response/cases' => 'FogBugz_Response_Cases',
		'//response/events' => 'FogBugz_Response_Events',
		'//response/projects' => 'FogBugz_Response_Projects',
		'//response/areas' => 'FogBugz_Response_Areas',
		'//resposne/fixfors' => 'FogBugz_Response_FixFors',
		'//response/priorities' => 'FogBugz_Response_Priorities',
		'//response/categories' => 'FogBugz_Response_Categories',
		'//response/workingSchedule' => 'FogBugz_Response_WorkingSchedule',
		'//response/intervals' => 'FogBugz_Response_Intervals',
		'//response/people' => 'FogBugz_Response_People',
		'//response/topic' => 'FogBugz_Response_Topic',
		'//response/discussions' => 'FogBugz_Response_Discussions',
		'//response/mailboxes' => 'FogBugz_Response_Mailboxes',
		'//response/settings' => 'FogBugz_Response_Settings',
		'//response/shipDate' => 'FogBugz_Response_ShipDate',
		'//response/error' => 'FogBugz_Response_Error'
	);

	function __construct($document) {
		$this->_document = $document;
	}

	public static function parse($result) {
		$document = new DOMDocument();
		$document->loadXML($result);
		// response check
		$xp = new DOMXPath($document);
		$response = $xp->query("//response");
		if ($response->length !== 1) {
			Throw new FogBugzException("XML response was missing <response> tag");
		}
		// test for special case "empty" response
		$response = $xp->query("//response/*");
		if ($response->length == 0) {
			return new FogBugz_Response_Empty($document);
		}

		// look for matching response class to initalize result into
		foreach(FogBugz_Response::response_mappings as $xpath => $result_class) {
			$response = $xp->query($xpath);
			if ($response->length > 0) {
				return new ${result_class}($document);
			}
		}
		// missing definition
		// TODO: make this error more specific
		Throw new FogBugzException("Missing Handler for Response");
	}
}

?>
