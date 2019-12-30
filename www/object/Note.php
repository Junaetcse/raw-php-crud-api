<?php

/**
 * Description of Department
 *
 * @author https://www.roytuts.com
 */
class Note {

    // database connection and table name
    private $conn;
    private $table_name = "notes";
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }


    function getNotes() {
        $query = "SELECT *
            FROM
                " . $this->table_name . " d
            ORDER BY
                d.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function searchNotes($search) {
        $query = "select * from ". $this->table_name . " where title like ? or description like ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array("%$search%" , "%$search%"));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findNote($id){
        $query = "select * from ". $this->table_name . " where id = ? limit 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array($id));
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function addNote($title,$description){
        $query = "insert into notes (title,description) values (?,?)";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array($title,$description))){
            return true;
        }else{
         return false;
        }
    }

    public function updateNote($id,$title,$description){
        $query = "update notes set title = ?, description = ? where id = ?";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array($title,$description,$id))){
            return true;
        }else{
         return false;
        }
    }

    public function deleteNote($id){
        $query = "delete from notes where id = ?";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array($id))){
            return true;
        }else{
         return false;
        }
    }

    // function create() {
    //     // query to insert record
    //     $query = "INSERT INTO
    //             " . $this->table_name . "
    //         SET
    //             dept_name=:name";
    //     // prepare query
    //     $stmt = $this->conn->prepare($query);
    //     // sanitize
    //     $this->name = htmlspecialchars(strip_tags($this->name));

    //     // bind values
    //     $stmt->bindParam(":name", $this->name);

    //     // execute query
    //     if ($stmt->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}