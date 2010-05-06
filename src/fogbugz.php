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
	}		
}
