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
		if (true && !empty($this->_params)) {
			$url = sprintf("%s?%s",$url,http_build_query($this->_params));
		}
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		if (false) {
			curl_setopt($ch,CURLOPT_POST,true);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$this->_params);
		} 
		$result = curl_exec($ch);
		$info = curl_getinfo($ch);
		if (curl_error($ch) != "") {
			Throw new FogBugzException(sprintf("Error fetching request, curl got error: %s",curl_error($ch)));
		}

		if ($info['http_code'] != "200") {
			Throw new FogBugzException(sprintf("Error fetching request, was expecting HTTP 200 code, got %s instead",$info['http_code']));
		}
		return FogBugz_Response::create($result);
	} 

	function _constructUrl() {
		$url = sprintf("%s/%s",$this->_fogbugz->getUrl(),$this->_accessor);
		return $url;
	}
}
?>
