<?php

require_once('fogbugz_test.php');

class FogBugzFilterTest extends FogBugzTest {

	function testGetFilters() {
		$this->fb->logon();
		$result = $this->fb->getFilters();
		$this->assertIsA($result,'FogBugz_Response_Filters');
		$this->assertNotEqual(count($result->_data),0);
	}

	function testSetFilter() {
		$this->fb->logon();
		$results = $this->fb->getFilters();
		$current = null;
		$my_new = null;
		foreach($results->_data as $filter) {
			if ($filter->getStatus() == 'current') {
				$current = $filter->getSFilter();
			}
		}
		foreach($results->_data as $filter) {
			if ($filter->getType() == 'saved' && $filter->getSFilter() != $current) {
				$my_new = $filter->getSFilter();
			}
		}
		$this->assertNotNull($current);
		$this->assertNotNull($my_new);
		$result_setFilter = $this->fb->setFilter($my_new);
		$this->assertIsA($result_setFilter,'FogBugz_Response_Empty');
		$result_setFilter = $this->fb->setFilter($current); // reset
		$this->assertIsA($result_setFilter,'FogBugz_Response_Empty');
	}	
}
