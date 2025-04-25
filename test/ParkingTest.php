<?php

use PHPUnit\Framework\TestCase;

class ParkingModelTest extends Test
{
    protected $model;

    protected function setUp()
    {
        parent::setUp();
        // Load the model for testing
        $this->model = new ParkingModel();
    }

    protected function tearDown()
    {
        // Unload the model after testing
        unset($this->model);
        parent::tearDown();
    }

    public function testGetParkingData()
    {
        // Test case 1: when $id is null
        $result = $this->model->getParkingData();
        $this->assertNotEmpty($result);

        // Test case 2: when $id is given
        $result = $this->model->getParkingData(1);
        $this->assertNotEmpty($result);
    }

    public function testCreate()
    {
        // Test case 1: when $data is empty
        $result = $this->model->create();
        $this->assertFalse($result);

        // Test case 2: when $data is given
        $data = array('name' => 'John Doe', 'vehicle_number' => 'ABC 123');
        $result = $this->model->create($data);
        $this->assertTrue($result);
    }

    public function testEdit()
    {
        // Test case 1: when $data and $id are empty
        $result = $this->model->edit();
        $this->assertFalse($result);

        // Test case 2: when $data and $id are given
        $data = array('name' => 'Jane Doe', 'vehicle_number' => 'XYZ 789');
        $result = $this->model->edit($data, 1);
        $this->assertTrue($result);
    }

    public function testDelete()
    {
        // Test case 1: when $id is empty
        $result = $this->model->delete();
        $this->assertFalse($result);

        // Test case 2: when $id is given
        $result = $this->model->delete(1);
        $this->assertTrue($result);
    }

    public function testUpdatePayment()
    {
        // Test case 1: when $id and $payment_status are empty
        $result = $this->model->updatePayment();
        $this->assertFalse($result);

        // Test case 2: when $id and $payment_status are given and $payment_status is 1
        $result = $this->model->updatePayment(1, 1);
        $this->assertTrue($result);

        // Test case 3: when $id and $payment_status are given and $payment_status is 0
        $result = $this->model->updatePayment(1, 0);
        $this->assertTrue($result);
    }

    public function testCountTotalParking()
    {
        $result = $this->model->countTotalParking();
        $this->assertGreaterThanOrEqual(0, $result);
    }

    public function testCountTotalEarning()
    {
        $result = $this->model->countTotalEarning();
        $this->assertGreaterThanOrEqual(0, $result);
    }

    public function testCountTotalUnpaid()
    {
        $result = $this->model->countTotalUnpaid();
        $this->assertGreaterThanOrEqual(0, $result);
    }
}