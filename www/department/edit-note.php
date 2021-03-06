<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/Db.php';
include_once '../object/Note.php';

// instantiate database and department object
$database = new Db();
$db = $database->getConnection();

    if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['id'])){
        $note = new Note($db);
        if($note->updateNote($_POST['id'],$_POST['title'],$_POST['description'])){
            echo json_encode(['status' => 'success']);
        }else{
            echo json_encode(['status' => 'Db error']);
        }

    }else{
        echo json_encode(['status' => 'error']);
    }


?>