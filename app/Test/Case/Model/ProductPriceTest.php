<?php
App::uses('ProductPrice', 'Model');

/**
 * ProductPrice Test Case
 *
 */
class ProductPriceTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.product_price', 'app.tenant', 'app.attachment', 'app.category', 'app.comment', 'app.config', 'app.download', 'app.group', 'app.user', 'app.user_profile', 'app.log', 'app.post', 'app.link', 'app.widget', 'app.article_category', 'app.product', 'app.product_license', 'app.customerentifier');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductPrice = ClassRegistry::init('ProductPrice');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductPrice);

		parent::tearDown();
	}

}
