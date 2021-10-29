<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/models/Users.php');

class UsersView extends Users {

    public function getUserName($user_id){
        $user = $this->get($user_id);
        if($user){
            echo '<p class="username">'.$user["username"].'</p>';
        }

    }


}



?>