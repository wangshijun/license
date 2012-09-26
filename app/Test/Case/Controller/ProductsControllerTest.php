<?php
App::uses('ProductsController', 'Controller');

/**
 * TestProductsController *
 */
class TestProductsController extends ProductsController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * ProductsController Test Case
 *
 */
class ProductsControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.product', 'app.tenant', 'app.attachment', 'app.category', 'app.comment', 'app.config', 'app.download', 'app.group', 'app.user', 'app.user_profile', 'app.log', 'app.post', 'app.link', 'app.widget', 'app.article_category', 'app.product_license', 'app.product_price');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Products = 	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Products);

		parent::tearDown();
	}

/**
 * testAdminIndex method
 *
 * @return void
 */
	public function testAdminIndex() {

	}
/**
 * testAdminView method
 *
 * @return void
 */
	public function testAdminView() {

	}
/**
 * testAdminAdd method
 *
 * @return void
 */
	public function testAdminAdd() {

	}
/**
 * testAdminEdit method
 *
 * @return void
 */
	public function testAdminEdit() {

	}
/**
 * testAdminDelete method
 *
 * @return void
 */
	public function testAdminDelete() {

	}
}
