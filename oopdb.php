<?php

class Database{

    protected $location;
    protected $username;
    protected $password;
    protected $database;
    protected $connection;

    public function __construct(){
        $this->location = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->database = "image_gallery";
        echo "Constructor called!";
    }

    public function connection(){
        $this->db = mysqli_connect($this->location, $this->username, $this->password, $this->database);
        if(!$this->db){
            return false;
        }else{
            return $this->db;
        }
    }

    public function query($query){
        return mysqli_query($this->db, $query);
    }

    public function fetchAssoc($data){
        return mysqli_fetch_assoc($data);
    }

    public function fetchObj($query){
        return mysqli_fetch_object($query);
    }

    public function fetchAll($data){
        return mysqli_fetch_all($data, MYSQLI_ASSOC);
    }

    public function error($connection){
        return mysqli_error($this->db);
    }

    public function errno($connection){
        return mysqli_errno($this->db);
    }

    public function __destruct(){
        @mysqli_close($this->db);
        echo "Destructor called!";
    }
}

$db = new Database();
$connection = $db->connection();
$connection->close();

