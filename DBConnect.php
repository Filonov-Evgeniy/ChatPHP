<?php
namespace Chat;

class DBConnect
{
    private static $instance;
    protected $host = "localhost";
    protected $user = "root";
    protected $password = "1234";
    protected $dbname = "chatDB";

    public function getConnection() {
        return mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
    }

    public static function getInstance(): DBConnect {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {}
    private function __clone() {}
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public function getOrderedList($from, $sortCol, $sortOrder): array {
        $connect = $this->getConnection();
        $result = mysqli_query($connect,"Select * from " .$from . " order by ".$sortCol." ".$sortOrder);
        $messagesCount = mysqli_num_rows($result);
        $_SESSION['db_rows_count'] = $messagesCount;
        $resultArray = [];
        for ($i = 0; $i < $messagesCount; $i++) {
            $resultArray[$i] = mysqli_fetch_assoc($result);
        }
        $connect->close();
        return $resultArray;
    }

    public function getFilteredList($from, array $filter, $separator) {
        $connect = $this->getConnection();
        $where = implode($separator, $filter);
        $result = mysqli_query($connect,"Select * from " .$from . " where ".$where);
        $connect->close();
        return $result;
    }

    public function create($table, array $values) {
        $connect = $this->getConnection();
        $valuesString = implode(', ', $values);
        $result = mysqli_query($connect,"insert into ". $table ." values($valuesString)");
        $connect->close();
    }

    public function filteredCreate($table, array $columns, array $values) {
        $connect = $this->getConnection();
        $columnsString = implode(', ', $columns);
        $valuesString = implode(', ', $values);
        $result = mysqli_query($connect,"insert into ".$table."(".$columnsString.")"." values($valuesString)");
    }
}