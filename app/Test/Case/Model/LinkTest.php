<?php
App::uses('Link', 'Model');

/**
 * Link Test Case
 *
 */
class LinkTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.link', 'app.tenant', 'app.attachment', 'app.category', 'app.post', 'app.user', 'app.group', 'app.download', 'app.log', 'app.comment', 'app.widget', 'app.config');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Link = ClassRegistry::init('Link');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Link);

		parent::tearDown();
	}

}
