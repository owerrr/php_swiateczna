<?php

class ConnectSql
{
    protected mysqli $connection;
    protected string $query;

    public function __construct(string $hostname = "localhost", string $username = "root", ?string $password = null, string $database = "3tipsp_prezenty")
    {
        $this->connection = mysqli_connect($hostname,$username,$password,$database);
    }

    public function __destruct(){
        $this->connection->close();
    }

    public function querySelect(string $query):array{
        $data = [];
            $q = mysqli_query($this->connection, $query);
            if($q){
                while($row = $q->fetch_row()){
                    $data[] = $row;
                }
            }
        return $data;
    }

    public function query(string $query):void{
        mysqli_query($this->connection, $query);
    }
}