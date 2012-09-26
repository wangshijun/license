<?php
App::uses('ProductLicense', 'Model');

/**
 * ProductLicense Test Case
 *
 */
class ProductLicenseTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.product_license', 'app.tenant', 'app.attachment', 'app.category', 'app.comment', 'app.config', 'app.download', 'app.group', 'app.user', 'app.user_profile', 'app.log', 'app.post', 'app.link', 'app.widget', 'app.article_category', 'app.product', 'app.product_price', 'app.customerentifier');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductLicense = ClassRegistry::init('ProductLicense');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductLicense);

		parent::tearDown();
	}

}
