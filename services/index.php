<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/controllers/Todo.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/controllers/Importance.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/views/Todo.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/views/Importance.php');
session_start();
$todos = new TodosController();
$schemas = new ImportancesController();
$todosView = new TodosView();
$schemasView = new ImportancesView();
$operation = $_POST["operation"];


function isOwner($item){
    if($item["user_id"]===$_SESSION["user_id"]){
        return true;
    }else{
        return false;
    }

}

if($operation==="complete"){
    $todoId = $_POST["id"];
    $todo = $todos->getTodoById($todoId);
    
    if(isOwner($todo)){
        $todos->updateTodo($todoId , $todo["content"] , 1 , $todo["importance"]);
    }
}elseif($operation==="delete"){
    $todoId = $_POST["id"];
    $todo = $todos->getTodoById($todoId);
    if(isOwner($todo)){
        $todos->destroyTodo($todoId);
    }
    
}elseif($operation==="insert"){
    $todo = filter_var($_POST["todo"],FILTER_SANITIZE_STRING);
    $importance = $_POST["select-importance"];
    $todo_id = $todos->createTodo($todo,$_SESSION["user_id"],0,$importance);
    if($todo_id){
        echo $todosView->getTodoById($todo_id);
    }
}elseif($operation==="insert-schema"){
    $schema_id = $schemas->createImportance($_POST["eimportant"],$_POST["vimportant"],$_POST["important"]
                                           ,$_POST["limportant"],$_POST["normal"],$_SESSION["user_id"]);
    if($schema_id){
        echo $schemasView->getSchemaById($schema_id);
    }
}elseif($operation==="delete-schema"){
    $schema_id = $_POST["id"];
    $schema = $schemas->getSchemaById($schema_id);
    if(isOwner($schema)){
        $schemas->deleteImportance($schema_id);
    }
}elseif($operation==="logout"){
    session_destroy();
}


