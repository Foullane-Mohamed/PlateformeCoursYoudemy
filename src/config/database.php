<?php
namespace Config;

use PDO;
use Dotenv\Dotenv;
use PDOException;

class Connection {
    private static $conn = null;

    public function __construct() {
        if (self::$conn === null) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
            $dotenv->load();

            $host = $_ENV['host'];
            $dbname = $_ENV['db_name'];
            $username = $_ENV['username'];
            $password = $_ENV['password'];

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                self::$conn = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $username,
                    $password,
                    $options
                );
            } catch (PDOException $e) {
                throw new PDOException("Connection error: " . $e->getMessage());
            }
        }
    }


    

    public static function getPDO() {
        if (self::$conn === null) {
            new self();
        }
        return self::$conn;
    }
}