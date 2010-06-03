<?php

class FogBugz {

	var $_url = null; // URL to installation
	var $_logon = null; // Login email or full logon name
	var $_password = null;
	var $_token = null; // token returned by fogbugz for API access

	function __construct($url=null,$logon=null,$password=null) {
		$this->_url = $url;
		$this->_logon = $logon;
		$this->_password = $password;
	}

	function logon() {
		$request = new FogBugz_Request($this);
		$request->setAccessor("api.xml");
		$response = $request->go();
		if (get_class($response) != 'FogBugz_Response_Api') {
			Throw new FogBugz_Exception('Fogbugz->Login did not receive Api response');
		}
		// verify API version we're working with
		// actually logon now
		$request = new FogBugz_Request($this);
		$request->setParams(array('cmd'=>'logon','email'=>$this->_logon,'password'=>$this->_password));
		$response = $request->go();
		if (get_class($response) != 'FogBugz_Response_Token') {
			Throw new FogBugz_Exception('FogBugz->Login did not receive Token response');
		}
		$this->_token = $response;
		return $response;
	}
	
	function logoff() {
		if (!empty($this->_token)) {
			$request = new FogBugz_Request($this);
			$request->setParams(array('cmd'=>'logoff','token'=>$this->_token->_data['token']));
			$response = $request->go();
			if (get_class($response) != 'FogBugz_Response_Empty') {
				return false;
			}
			return true;
		}
		print_r($this->_token);
		return false;
	}

	function getFilters() {
		$request = new FogBugz_Request($this);
		$request->setParams(array('cmd'=>'listFilters','token'=>$this->_token->_data['token']));
		return $request->go();
	}

	function setFilter($sFilter) {
		Throw new FogBugz_Exception("setFilter not implemented");
	}

	function search($q=null,$cols=null,$max=null) {
		$request = new FogBugz_Request($this);
		$params = array(
			'token' => $this->_token->_data['token'],
			'cmd' => 'search'
		);
		if (!empty($q)) {
			$params['q'] = $q;
		}
		if (!empty($cols)) {
			$params['cols'] = $cols;
		}
		if (!empty($max) && is_numeric($max)) {
			$params['max'] = $max;
		}
		$request->setParams($params);
		return $request->go();
	}

	function getUrl() {
		return $this->_url;
	}

	function getToken() {
		return $this->_token;
	}	
}
