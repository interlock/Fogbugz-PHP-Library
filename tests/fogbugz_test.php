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
		$this->fb->logoff();
		unset($this->fb);
	}

	function testLogonSuccess() {
		$response = $this->fb->logon();
		$this->assertIsA($response,'FogBugz_Response_Token');
	}

	function testLogoff() {
		$this->fb->logon();
		$this->assertTrue($this->fb->logoff());
	}

}
