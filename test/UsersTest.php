<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase 
{
    private $user;

    protected function setUp(): void 
    {
        $this->user = new User();
    }

    public function testGetUserDataWithId() 
    {
        $userData = $this->user->getUserData(1);
        $this->assertIsArray($userData);
        $this->assertEquals(1, $userData['id']);
    }

    public function testGetUserDataWithoutId() 
    {
        $userData = $this->user->getUserData();
        $this->assertIsArray($userData);
        $this->assertGreaterThan(0, count($userData));
    }

    public function testGetUserGroupWithId() 
    {
        $userGroup = $this->user->getUserGroup(1);
        $this->assertIsArray($userGroup);
        $this->assertArrayHasKey('group_id', $userGroup);
    }

    public function testCreateUserAndGroup() 
    {
        $data = array(
            'name' => 'Test User',
            'email' => 'test@example.com'
        );

        $groupId = 1;

        $this->assertTrue($this->user->create($data, $groupId));
    }

    public function testEditUserAndGroup() 
    {
        $id = 1;
        $data = array(
            'name' => 'Updated Name'
        );

        $groupId = 2;

        $this->assertTrue($this->user->edit($data, $id, $groupId));
    }

    public function testDeleteUser() 
    {
        $id = 1;
        $this->assertTrue($this->user->delete($id));
    }

    public function testCountTotalUsers() 
    {
        $this->assertGreaterThan(0, $this->user->countTotalUsers());
    }
}