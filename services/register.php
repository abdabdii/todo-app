<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/controllers/User.php');
session_start();



$username = filter_var($_POST["username"],FILTER_SANITIZE_STRING);
$email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
$password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$user = new UsersController();

$id = $user->createUser($username,$email,$password_hash);
if($id){
    $_SESSION["user_id"] = $id;
    echo $id;
}


