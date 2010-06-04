<?php

class FogBugz_Response_Events extends FogBugz_Response {
	function __construct($document) {
		$this->_document = $document;
		$this->_data = $this->toArray($document);
	}

	protected function toArray($node = null) {
		$data = array();
		if ($node === null) {
			if ($this->_document->nodeName == 'events') {
				$node = $this->_document;
			} else {
				// query node out
				return $data;
			}
		}

		if ($node == null) printf("NULL NODE!");


		// process
		foreach($node->childNodes as $childNode) {
			if ($childNode->nodeName == 'event') {
				$data[] = new FogBugz_Response_Event($childNode);
			}
		}
		return $data;
	}
}

?>
