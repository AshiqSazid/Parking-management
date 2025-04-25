<?php

use PHPUnit\Framework\TestCase;

class Model_companyTest extends TestCase
{
    protected static $model;

    public static function setUpBeforeClass(): void
    {
        self::$model = new Model_company();
        self::$model->db->query("INSERT INTO company (id, name, address, email, phone) VALUES (1, 'Test Company', '123 Test St', 'test@example.com', '555-555-5555')");
    }

    public function testGetCompanyData()
    {
        $company = self::$model->getCompanyData(1);

        $this->assertIsArray($company);
        $this->assertArrayHasKey('id', $company);
        $this->assertArrayHasKey('name', $company);
        $this->assertArrayHasKey('address', $company);
        $this->assertArrayHasKey('email', $company);
        $this->assertArrayHasKey('phone', $company);
        $this->assertEquals('Test Company', $company['name']);
    }

    public function testEdit()
    {
        $data = [
            'name' => 'New Test Company',
            'address' => '456 New St',
            'email' => 'newtest@example.com',
            'phone' => '555-555-1234'
        ];
        $result = self::$model->edit($data, 1);

        $this->assertTrue($result);

        $company = self::$model->getCompanyData(1);

        $this->assertEquals('New Test Company', $company['name']);
        $this->assertEquals('456 New St', $company['address']);
        $this->assertEquals('newtest@example.com', $company['email']);
        $this->assertEquals('555-555-1234', $company['phone']);
    }

    public static function tearDownAfterClass(): void
    {
        self::$model->db->query("DELETE FROM company WHERE id = 1");
        self::$model = null;
    }
}