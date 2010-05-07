<?php

class FogBugz {

	var $_url = null; // URL to installation
	var $_login = null; // Login email or full login name
	var $_password = null;
	var $_token = null; // token returned by fogbugz for API access

	function __construct($url=null,$login=null,$password=null) {
		$this->_url = $url;
		$this->_login = $login;
		$this->_password = $password;
	}

	function login() {
		$request = new FogBugz_Request($this);
		$request->setAccessor("api.xml");
		$response = $request->go();
		if (get_class($response) != 'FogBugz_Response_Api') {
			Throw new FogBugzException('Fogbugz->Login did not receive Api response');
		}
		// verify API version we're working with
		// actually login now
		$request = new FogBugz_Request($this);
		$request->setParams(array('cmd'=>'login','email'=>$this->_login,'password'=>$this->_password));
		$response = $request->go();
		if (get_class($response) != 'FogBugz_Response_Token') {
			Throw new FogBugzException('FogBugz->Login did not receive Token response');
		}
		$this->_token = $response;
		return $response;
	}

	function getUrl() {
		return $this->_url;
	}	
}
