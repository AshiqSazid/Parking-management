<?php

use PHPUnit\Framework\TestCase;

class CheckEmailTest extends TestCase
{
    protected $db;

    protected function setUp(): void
    {
        // Set up the database connection
        $this->db = new mysqli('localhost', 'username', 'password', 'test_db');
    }

    protected function tearDown(): void
    {
        // Close the database connection
        $this->db->close();
    }

    public function testCheckEmailExists()
    {
        // Test with an email that exists in the database
        $email = 'test@example.com';

        $result = $this->check_email($email);

        $this->assertTrue($result);
    }

    public function testCheckEmailNotExists()
    {
        // Test with an email that does not exist in the database
        $email = 'nonexistent@example.com';

        $result = $this->check_email($email);

        $this->assertFalse($result);
    }

    protected function check_email($email)
    {
        // Call the check_email function
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows();
        $stmt->close();
        return ($result == 1) ? true : false;
    }
}

class LoginTest extends TestCase
{
    protected $db;

    protected function setUp(): void
    {
        // Set up the database connection
        $this->db = new mysqli('localhost', 'username', 'password', 'test_db');
    }

    protected function tearDown(): void
    {
        // Close the database connection
        $this->db->close();
    }

    public function testLoginWithCorrectCredentials()
    {
        // Test with correct email and password
        $email = 'test@example.com';
        $password = 'password123';

        $result = $this->login($email, $password);

        $this->assertIsArray($result);
    }

    public function testLoginWithIncorrectPassword()
    {
        // Test with correct email and incorrect password
        $email = 'test@example.com';
        $password = 'wrongpassword';

        $result = $this->login($email, $password);

        $this->assertFalse($result);
    }

    public function testLoginWithNonexistentEmail()
    {
        // Test with nonexistent email
        $email = 'nonexistent@example.com';
        $password = 'password123';

        $result = $this->login($email, $password);

        $this->assertFalse($result);
    }

    protected function login($email, $password)
    {
        // Call the login function
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $query = $stmt->get_result();
        $stmt->close();

        if ($query->num_rows() == 1) {
            $result = $query->fetch_assoc();

            $hash_password = password_verify($password, $result['password']);
            if ($hash_password === true) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}