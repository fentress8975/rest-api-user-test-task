<?php
class user
{

    private $db;
    private $table_name = "users";

    public $id;
    public $login;
    public $password;
    public $description;
    public $created;
    public $modified;
    public $deleted;

    function __construct($db)
    {
        $this->db = $db;
    }


    function readOne(){
        
    }

    function create(){

    }

    function delete(){

    }

    function update(){

    }

    function authentication(){

    }
    
}
