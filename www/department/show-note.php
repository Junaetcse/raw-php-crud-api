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

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];
        $note = new Note($db);
        $note_data = $note->findNote($id);
        echo json_encode(['success:true',$note_data]);
    }
?>