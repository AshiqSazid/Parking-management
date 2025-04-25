<?php

use PHPUnit\Framework\TestCase;

class ParkingTest extends TestCase {
    protected $parking_model;

    protected function setUp(): void {
        $this->parking_model = new Parking_model();
    }

    public function testGetParkingYear(): void {
        $years = $this->parking_model->getParkingYear();
        $this->assertIsArray($years);
        $this->assertNotEmpty($years);
    }

    public function testGetParkingData(): void {
        $year = '2022';
        $data = $this->parking_model->getParkingData($year);

        $this->assertIsArray($data);
        $this->assertNotEmpty($data);

        foreach ($data as $month => $parking_records) {
            $this->assertIsArray($parking_records);
            $this->assertNotEmpty($parking_records);

            foreach ($parking_records as $parking_record) {
                $this->assertIsArray($parking_record);
                $this->assertArrayHasKey('id', $parking_record);
                $this->assertArrayHasKey('in_time', $parking_record);
                $this->assertArrayHasKey('out_time', $parking_record);
            }
        }
    }
}