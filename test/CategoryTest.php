<?php

use PHPUnit\Framework\TestCase;

class Model_category_test extends TestCase
{
    public function testGetCategoryDataReturnsCorrectResultWhenGivenId()
    {
        $model = new Model_category();
        $expected_result = array('id' => 1, 'name' => 'Car', 'description' => 'A four-wheeled vehicle');
        $result = $model->getCategoryData(1);
        $this->assertEquals($expected_result, $result);
    }

    public function testGetCategoryDataReturnsAllCategoriesWhenGivenNoId()
    {
        $model = new Model_category();
        $expected_result = array(
            array('id' => 1, 'name' => 'Car', 'description' => 'A four-wheeled vehicle'),
            array('id' => 2, 'name' => 'Bike', 'description' => 'A two-wheeled vehicle'),
            array('id' => 3, 'name' => 'Truck', 'description' => 'A large vehicle for transporting goods')
        );
        $result = $model->getCategoryData();
        $this->assertEquals($expected_result, $result);
    }

    public function testGetActiveCategoryDataReturnsOnlyActiveCategories()
    {
        $model = new Model_category();
        $expected_result = array(
            array('id' => 1, 'name' => 'Car', 'description' => 'A four-wheeled vehicle')
        );
        $result = $model->getActiveCategoryData();
        $this->assertEquals($expected_result, $result);
    }

    public function testCreateInsertsDataIntoDatabase()
    {
        $model = new Model_category();
        $data = array('name' => 'SUV', 'description' => 'A large vehicle for families');
        $model->create($data);

        $query = $this->db->get_where('vechile_category', array('name' => 'SUV'));
        $result = $query->row_array();
        $this->assertEquals($data, $result);

        $this->db->delete('vechile_category', array('name' => 'SUV'));
    }

    public function testEditUpdatesDataInDatabase()
    {
        $model = new Model_category();
        $data = array('description' => 'A two-wheeled vehicle for sport');
        $id = 2;
        $model->edit($data, $id);

        $query = $this->db->get_where('vechile_category', array('id' => $id));
        $result = $query->row_array();
        $this->assertEquals($data['description'], $result['description']);

        // Reset data to original state
        $this->db->where('id', $id);
        $this->db->update('vechile_category', array('description' => 'A two-wheeled vehicle'));
    }

    public function testDeleteRemovesDataFromDatabase()
    {
        $model = new Model_category();
        $id = 3;
        $model->delete($id);

        $query = $this->db->get_where('vechile_category', array('id' => $id));
        $result = $query->num_rows();
        $this->assertEquals(0, $result);

        // Reset data to original state
        $this->db->insert('vechile_category', array('id' => $id, 'name' => 'Truck', 'description' => 'A large vehicle for transporting goods', 'active' => 1));
    }
}