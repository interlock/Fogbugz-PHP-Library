<?php

class FogBugz_Response_Filter extends FogBugz_Response {
	var $_type = null; // builtin, saved, shared
	var $_sFilter = null; //internal id
	var $_status = null; // current or null
	var $_name = null; // string

	function __construct($document) {
		$this->_document = $document;
		$this->initFromDocument();
	}

	function initFromDocument() {
		if ($this->_document->hasAttributes()) {
			if ($this->_document->hasAttribute('type')) {
				$this->_type = $this->_document->getAttribute('type');
			} else {
				Throw new FogBugz_Exception("Missing filter attribute type");
			}

			if ($this->_document->hasAttribute('sFilter')) {
				$this->_sFilter = $this->_document->getAttribute('sFilter');
			} else {
				Throw new FogBugz_Exception("Missing filter attribute sFilter");
			}
			if ($this->_document->hasAttribute('status')) {
				$this->_status = $this->_document->getAttribute('status');
			}
			if ($this->_document->hasChildNodes()) {
				$this->_name = $this->_document->textContent;
			}
		} else {
			Throw new FogBugz_Exception("Was expecting XML element with attributes");
		}
	}

	// gets/sets
	function getType() {
		return $this->_type;
	}
	
	function getSFilter() {
		return $this->_sFilter;
	}

	function getStatus() {
		return $this->_status;
	}

	function getName() {
		return $this->_name;
	}
}

?>
