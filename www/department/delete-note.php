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

    if(isset($_POST['id'])){
        $note = new Note($db);
        if($note->deleteNote($_POST['id'])){
            echo json_encode(['status' => 'success']);
        }else{
            echo json_encode(['status' => 'error']);
        }

    }else{
        echo json_encode(['status' => 'error']);
    }


?>