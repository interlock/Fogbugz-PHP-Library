<?php

require_once('simpletest/autorun.php');
require_once('config.php');

class AllTests extends TestSuite {

	var $tests = array(
		'fogbugz',
		'fogbugz_search'
	);

	function AllTests() {
		$this->TestSuite('All Tests');
		foreach($this->tests as $test) {
			$this->addFile(sprintf("%s_test.php",$test));
		}
	}
}

?>
