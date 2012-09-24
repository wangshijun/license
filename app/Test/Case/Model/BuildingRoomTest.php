<?php
App::uses('BuildingRoom', 'Model');

/**
 * BuildingRoom Test Case
 *
 */
class BuildingRoomTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.building_room', 'app.tenant', 'app.attachment', 'app.category', 'app.comment', 'app.config', 'app.download', 'app.download_category', 'app.group', 'app.user', 'app.user_profile', 'app.log', 'app.post', 'app.link', 'app.widget', 'app.building_block', 'app.building', 'app.building_resident', 'app.ethnic_group');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BuildingRoom = ClassRegistry::init('BuildingRoom');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BuildingRoom);

		parent::tearDown();
	}

}
