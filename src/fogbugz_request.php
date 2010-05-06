<?php

class FogBugz_Request {

	var $_fogbugz = null;
	var $_accessor = "api.asp";
	var $_params = array();

	function __construct($fogbugz) {
		if (is_object($fogbugz) && get_class($fogbugz) == "FogBugz") {
			$this->_fogbugz = $fogbugz;
		} else {
			Throw new FogBugzException("Invalid Object Passed, Was Expecting Class Fogbugz");
		}
	}

	function setAccessor($accessor) {
		$this->_accessor = $accessor;
	}

	function setParams($params) {
		$this->_params = $params;
	}

	function go() {
		$url = $this->_constructUrl();
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_POSt,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$this->_params);
		$result = curl_exec($ch);
		$info = curl_info($ch);
		if ($info['http_code'] != "200") {
			Throw new FogBugzException("Error fetching request, was expecting HTTP 200 code");
		}
		if (curl_error($ch) != "") {
			Throw new FogBugzException(sprintf("Error fetching request, curl got error: %s",curl_error($ch)));
		}
		return FogBugz_Response::parse($result);
	} 

	function _constructUrl() {
		$url = sprintf("%s/%s",$this->_fogbugz->getUrl(),$this->_accessor);
		return $url;
	}
}
?>
