<?php
App::uses('Category', 'Model');

/**
 * Category Test Case
 *
 */
class CategoryTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.category', 'app.tenant', 'app.attachment', 'app.comment', 'app.config', 'app.download', 'app.group', 'app.user', 'app.log', 'app.post', 'app.link', 'app.widget');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Category = ClassRegistry::init('Category');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Category);

		parent::tearDown();
	}

}
