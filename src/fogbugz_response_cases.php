<?php

class FogBugz_Response_Cases extends FogBugz_Response {

	function __construct($document) {
		$this->_document = $document;
		$this->_data = $this->_process();
	}

	function _process() {
    $xp = new DOMXPath($this->_document);
    $response = $xp->query('//response');
    if ($response->length != 1) {
      die('Handle this');
    }
    $nodes = $response->item(0);
		$data = array();
		foreach ($nodes->childNodes as $node) {
			if ($node->nodeName == "cases") {
				foreach($node->childNodes as $caseNode) {
					if ( $caseNode->nodeName == "case" ) {
						$data[] = new FogBugz_Response_Case($caseNode);
					}
				}
			}
		}
		return $data;
	}
}
?>
