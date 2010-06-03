<?php

require_once('fogbugz_test.php');

class FogBugzSearchTest extends FogBugzTest {

	function testSearch() {
		$this->fb->logon();
		$result = $this->fb->search();
		$this->assertIsA($result,'FogBugz_Response_Cases');
		$this->assertNotEqual(count($result->_data),0);
	}

	function testSearchCols() {
		$this->fb->logon();
		$result = $this->fb->search(null,"ixProject",null);
		$this->assertTrue(isset($result->_data[0]->_data['ixProject']));
	}

	function testSearchMax() {
		$this->fb->logon();
		$result = $this->fb->search(null,null,1);
		$this->assertEqual(count($result->_data),1);
	}

}
