<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/controllers/User.php');
$email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
$password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);

$user = new UsersController();

$authUser = $user->authUser($email,$password);


if($authUser){
    $id = $authUser;
    $_SESSION["user_id"] = $id;
    echo $id;
}else{
    echo "false";
}



?>