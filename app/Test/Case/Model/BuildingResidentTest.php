<?php
App::uses('BuildingResident', 'Model');

/**
 * BuildingResident Test Case
 *
 */
class BuildingResidentTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.building_resident', 'app.tenant', 'app.attachment', 'app.category', 'app.comment', 'app.config', 'app.download', 'app.download_category', 'app.group', 'app.user', 'app.user_profile', 'app.log', 'app.post', 'app.link', 'app.widget', 'app.building_room', 'app.ethnic_group');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BuildingResident = ClassRegistry::init('BuildingResident');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BuildingResident);

		parent::tearDown();
	}

}
