<?php

class FogBugz_Response_Event extends FogBugz_Response {
	function __construct($document) {
		$this->_document = $document;
		$this->_data = $this->toArray($document);
	}
}
