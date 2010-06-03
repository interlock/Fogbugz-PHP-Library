<?php

require_once('../src/fogbugz_init.php');

class FogBugzTest extends UnitTestCase {

	protected $fb = null;

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

	function testGetFilters() {
		$this->fb->logon();
		$result = $this->fb->getFilters();
		$this->assertIsA($result,'FogBugz_Response_Filters');
	}

}
?>
