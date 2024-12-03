<?php

class Database
{
    private $host     = 'mysql';
    private $dbname   = 'test';
    private $user     = 'root';
    private $password = 'root';
    private $port     = 3306;
    private $charset  = 'utf8mb4';

    public $db;

    public function getConnection()
    {
        
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $db = new mysqli($this->host, $this->user, $this->password, $this->dbname, $this->port);
            $db->set_charset($this->charset);
            $db->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
        } catch (\Throwable $th) {
            echo "Ошибка подключения к БД: \n";
            echo $th->getMessage();
            die();
        }

    }

    function __destruct()
    {
        mysqli_close($this->db);  
    }
}