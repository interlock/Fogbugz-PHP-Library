<?php

class FogBugz_Response_Case extends FogBugz_Response {
	var $shallow = true; // no attributes for case set, usually a search with col=0
	var $operations = array(); // operations this case will accept

	function __construct($document) {
		$this->_document = $document;
		$this->_data = $this->toArray($document);
	}

	protected function toArray($node = null) {
		$data = array();
		if ($node == null) return $data;
		if ($node->nodeName != "case") return $data;
		
		// parse actions in and store
		foreach($node->attributes as $attr) {
			if ($attr->name == "ixBug") {
				$data[$attr->name] = $attr->value;
			} else if ($attr->name == "operations") {
				$this->operations = explode(",",$attr->value);
			}
		}

		if ($node->childNodes->length != 0 ) {
			foreach ($node->childNodes as $childNode) {
				$data[$childNode->nodeName] = $childNode->textContent;
			}
			$this->shallow = false;
		}

		return $data;	
	}
}
?>
