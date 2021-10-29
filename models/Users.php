<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/config/Database.php');

Class Users extends Database{

    
    /**
     * create
     *
     * @param  String $username
     * @param  String $email
     * @param  String $password_hash
     * @return String States if the Insert is success or not
     */
    protected function create($username,$email,$password_hash){
        $sql = 'INSERT INTO users(username,email,password_hash) VALUES (?,?,?)';

        $stmt = $this->conn->prepare($sql);
        try{
            $stmt->execute([$username,$email,$password_hash]);
            
        }catch(PDOException $e){
            echo 'Insert failed!';
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    /**
     * get
     *
     * @param  mixed $id
     * @return Array that contains email and username
     */
    protected function get($id){
        $sql = 'SELECT email , username FROM users WHERE id=?';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        return $result;
    }
    
    /**
     * check
     *
     * @param  String $email
     * @param  String $password_hash
     * @return Array that contains the user id
     */
    protected function check($email){
        $sql = 'SELECT id , password_hash FROM users WHERE email=?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    
    /**
     * update
     *
     * @param  Integar $id
     * @param  String $username
     * @param  String $email
     * @param  String $password_hash
     * @return String States if the update is success or not
     */
    protected function update($id,$username,$email,$password_hash){
        $sql = 'UPDATE users SET username=? , email=? , password_hash=? WHERE id=?';
        $stmt = $this->conn->prepare($sql);
        
        try{
            $stmt->execute([$username,$email,$password_hash,$id]);
            
            echo 'User was updated successfully';
        }catch(PDOException $e){
            echo 'Update failed!';
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    /**
     * destroy
     *
     * @param  Integar $id id of user
     * @return String States if the delete is success or not
     */
    protected function destroy($id){
        $sql = 'DELETE FROM users WHERE id=?';

        $stmt = $this->conn->prepare($sql);
        
        try{
            $stmt->execute([$id]);
            
            echo 'User was deleted successfully';
        }catch(PDOException $e){
            echo 'Delete failed!';
            echo 'Error: ' . $e->getMessage();
        }
    }
}