<?php
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    //PDO实例
    private $_pdo;

    /**
     * 初始化数据表
     */
    public function setUp()
    {
        $this->_pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_pdo->query("CREATE TABLE hello_world (key) VARCHAR(50) NOT NULL)");
    }

    /**
     * 删除数据表
     */
    public function tearDown()
    {
        $this->_pdo->query("DROP TABLE hello_world");
    }
}
