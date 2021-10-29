<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/models/Users.php');

class UsersController extends Users{
    
    /**
     * createUser
     *
     * @param  String $username
     * @param  String $email
     * @param  String $password_hash
     * @return Integar return last inserted id
     */
    public function createUser($username,$email,$password_hash){
        $this->create($username,$email,$password_hash);
        return $this->conn->lastInsertId();
    }
    
    /**
     * updateUser
     *
     * @param  Integar $id of user to update
     * @param  String $username
     * @param  String $email
     * @param  String $password_hash
     * @return Bolean if success 
     */
    public function updateUser($id,$username,$email,$password_hash){
        $this->update($id,$username,$email,$password_hash);
        return true;
    }
    
    /**
     * deleteUser
     *
     * @param  Integar $id id of user
     * @return Bolean if success
     */
    public function deleteUser($id){
        $this->destroy($id);
        return true;
    }

    public function authUser($email,$password){
        $authedUser = $this->check($email);
        if($authedUser){
            $verifyPassword = password_verify($password,$authedUser["password_hash"]);
            if($verifyPassword){
                return $authedUser["id"];
            }
        }
        return false;
        
    }
}



//TESTING

// $userCont = new UsersController();
// $id = $userCont->createUser('greatusername','potato@email.com','greatpasswordhash');
// $userCont->updateUser(1,'greatusername','potato@email.com','greatpasswordhasssh');
// $userCont->deleteUser(1);