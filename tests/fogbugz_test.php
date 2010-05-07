<?php

require_once('../src/fogbugz_init.php');

class FogBugzTest extends UnitTestCase {

	private $fb = null;

	function setUp() {
		global $fogbugz_url,$fogbugz_login,$fogbugz_password;
		$this->fb = new FogBugz(
			$fogbugz_url,$fogbugz_login,$fogbugz_password
		);
	}

	function tearDown() {
		unset($this->fb);
	}

	function testLoginSuccess() {
		$response = $this->fb->login();
		assertIsA($response,'FogBugz_Response_Token');
	}

}
