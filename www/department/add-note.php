<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('P3P: CP="CAO PSA OUR"'); // Makes IE to support cookies
// include database and object files
include_once '../config/Db.php';
include_once '../object/Note.php';

// instantiate database and department object
$database = new Db();
$db = $database->getConnection();
    if(isset($_POST['title']) && isset($_POST['description'])){
        $note = new Note($db);
        if($note->addNote($_POST['title'],$_POST['description'])){
            echo json_encode(['status' => 'success']);
        }else{
            echo json_encode(['status' => 'error' ,'message' => 'Data added fail']);
        }

    }else{
        echo json_encode(['status' => 'error','message' => 'required field eror']);
    }


?>