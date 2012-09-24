<?php
App::uses('Config', 'Model');

/**
 * Config Test Case
 *
 */
class ConfigTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.config', 'app.tenant', 'app.attachment', 'app.category', 'app.comment', 'app.download', 'app.group', 'app.user', 'app.log', 'app.post', 'app.link', 'app.widget');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Config = ClassRegistry::init('Config');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Config);

		parent::tearDown();
	}

}
