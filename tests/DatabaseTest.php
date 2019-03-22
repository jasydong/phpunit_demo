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
        //创建表结构
        $query = "CREATE TABLE hello_world (`id` int(10) NOT NULL AUTO_INCREMENT, `key` VARCHAR(64) NOT NULL, PRIMARY KEY (`id`))";
        $this->_pdo->query($query);
        //插入记录
        $this->insertRecord();
    }

    /**
     * 删除数据表
     */
    public function tearDown()
    {
        $this->_pdo->query("DROP TABLE hello_world");
    }

    /**
     * 插入记录
     */
    public function insertRecord()
    {
        $v = md5('hello');
        $this->_pdo->query("insert into hello_world (`key`) values ('{$v}')");
    }

    /**
     * 获取记录测试
     */
    public function testFetchRecord()
    {
        $sql = "select * from hello_world;";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $this->assertEquals(1, count($rows));
    }
}
