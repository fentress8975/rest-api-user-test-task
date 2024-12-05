<?php
class user
{

    private mysqli $db;
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


    function readOne()
    {
        $sql = "SELECT id, login, description, created, modified, deleted FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->id]);
        $row = $stmt->get_result()->fetch_assoc();

        $this->id = $row['id'];
        $this->login = $row['login'];
        $this->description = $row['description'];
        $this->created = $row['created'];
        $this->modified = $row['modified'];
        $this->deleted = $row['deleted'];
    }

    function create()
    {
        $sql = "INSERT INTO users(login, password, description) VALUES (?,?,?)";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute([$this->login, $this->password, $this->description])) {
            return true;
        }

        return false;
    }

    function delete()
    {
        $sql = "UPDATE users SET deleted = 1 WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        if ($stmt->execute([$this->id])) {
            return true;
        }
    }

    function update()
    {
        //$sql = "UPDATE users SET login = ?, password = ?, description = ? WHERE id = ?";
        $sql = "UPDATE users SET ";
        if (!empty($this->login)) {
            $sql .= "login = ?, ";
            $args[] = $this->login;
        }
        if (!empty($this->password)) {
            $sql .= "password = ?, ";
            $args[] = $this->password;
        }
        if (!empty($this->description)) {
            $sql .= "description = ? ";
            $args[] = $this->description;
        }
        $sql .= "WHERE id = ?";
        $args[] = $this->id;

        $stmt = $this->db->prepare($sql);
        if ($stmt->execute($args)) {
            return true;
        }

        return false;
    }

    function authentication() {}

    function read()
    {
        $sql = "SELECT id, login, description, created, modified, deleted FROM users WHERE 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
