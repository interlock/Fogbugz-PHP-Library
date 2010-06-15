<?php

class FogBugz_Response_Filters extends FogBugz_Response {
	
	protected function toArray($node = null) {
		if ($node == null) {
			$xp = new DOMXPath($this->_document);
			$response = $xp->query('//response/filters');
			if ($response->length != 1) {
				die('Handle this');
			}
			$node = $response->item(0);
		}
		$data = array();
		foreach($node->childNodes as $childNode) {
			if ( ($childNode->nodeName == 'filter') ) {
				$data[] = new FogBugz_Response_Filter($childNode);
			}
		}
		return $data;
	}

}

?>
