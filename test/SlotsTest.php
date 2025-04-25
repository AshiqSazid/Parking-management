<?php

use PHPUnit\Framework\TestCase;

class SlotsTest extends TestCase {
    
    private $slots_model;
    
    public function setUp() {
        // Instantiate the model and any dependencies needed
        $this->slots_model = new Slots_model();
    }
    
    public function testGetSlotData() {
        // Test if the function returns an array of slots
        $slots = $this->slots_model->getSlotData();
        $this->assertIsArray($slots);
    }
    
    public function testCreate() {
        // Test if a new slot can be created
        $data = array(
            'slot_number' => 'A1',
            'availability_status' => 1,
            'active' => 1
        );
        $create = $this->slots_model->create($data);
        $this->assertTrue($create);
    }
    
    public function testEdit() {
        // Test if a slot can be edited
        $data = array(
            'slot_number' => 'A2'
        );
        $edit = $this->slots_model->edit($data, 1);
        $this->assertTrue($edit);
    }
    
    public function testDelete() {
        // Test if a slot can be deleted
        $delete = $this->slots_model->delete(1);
        $this->assertTrue($delete);
    }
    
    public function testUpdateSlotAvailability() {
        // Test if a slot's availability status can be updated
        $data = array(
            'availability_status' => 0
        );
        $update = $this->slots_model->updateSlotAvailability($data, 2);
        $this->assertTrue($update);
    }
    
    public function testGetAvailableSlotData() {
        // Test if the function returns an array of available slots
        $available_slots = $this->slots_model->getAvailableSlotData();
        $this->assertIsArray($available_slots);
    }
    
    public function testCountTotalSlots() {
        // Test if the function returns the total number of slots
        $total_slots = $this->slots_model->countTotalSlots();
        $this->assertIsInt($total_slots);
    }
    
    public function testCountTotalAvailableSlots() {
        // Test if the function returns the total number of available slots
        $total_available_slots = $this->slots_model->countTotalAvailableSlots();
        $this->assertIsInt($total_available_slots);
    }
}