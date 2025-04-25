<?php

use PHPUnit\Framework\TestCase;

class RateModelTest extends TestCase
{
    protected $model;

    protected function setUp(): void
    {
        $this->model = new RateModel();
    }

    public function testGetRateDataWithId()
    {
        // Test with existing id
        $data = $this->model->getRateData(1);
        $this->assertIsArray($data);
        $this->assertArrayHasKey('id', $data);
        $this->assertEquals(1, $data['id']);

        // Test with non-existing id
        $data = $this->model->getRateData(999);
        $this->assertNull($data);
    }

    public function testGetRateDataWithoutId()
    {
        $data = $this->model->getRateData();
        $this->assertIsArray($data);
        $this->assertGreaterThan(0, count($data));
    }

    public function testCreate()
    {
        $data = array(
            'vechile_cat_id' => 1,
            'rate' => 50
        );
        $result = $this->model->create($data);
        $this->assertTrue($result);
    }

    public function testEdit()
    {
        $data = array(
            'vechile_cat_id' => 1,
            'rate' => 60
        );
        $result = $this->model->edit($data, 1);
        $this->assertTrue($result);
    }

    public function testDelete()
    {
        $result = $this->model->delete(1);
        $this->assertTrue($result);
    }

    public function testGetCategoryRate()
    {
        $data = $this->model->getCategoryRate(1);
        $this->assertIsArray($data);
        $this->assertGreaterThan(0, count($data));
    }

    public function testCountTotalRates()
    {
        $count = $this->model->countTotalRates();
        $this->assertIsInt($count);
        $this->assertGreaterThan(0, $count);
    }
}