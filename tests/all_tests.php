<?php

require_once('simpletest/autorun.php');

class AllTests extends TestSuite {

	var $tests = array(
		'fogbugz'
	);

	function AllTests() {
		$this->TestSuite('All Tests');
		foreach($this->tests as $test) {
			$this->addFile(sprintf("%s_test.php",$test));
		}
	}
}

?>
