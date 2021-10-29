<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/config/Database.php');

Class Importances extends Database{
    
    /**
     * create
     *
     * @param  String $eimportant extremely important column
     * @param  String $vimportant very important column
     * @param  String $imporant   important column
     * @param  String $limportant less important column
     * @param  String $normal     normal column
     * @return String  States if the insert is success or not
     */
    protected function create($eimportant,$vimportant,$imporant,$limportant,$normal,$user_id){
        $sql = 'INSERT INTO  importance (extremely_important,very_important,important,less_important,normal,user_id) 
                VALUES (?,?,?,?,?,?) ';
        $stmt = $this->conn->prepare($sql);
        
        try{
            $stmt->execute([$eimportant,$vimportant,$imporant,$limportant,$normal,$user_id]);
            
            
            return $this->conn->lastInsertId();
        }catch(PDOException $e){
            echo 'Insert failed!';
            echo 'Error: ' . $e->getMessage();
        }
    }

    
    /**
     * get color schemas for user
     *
     * @param  Integar $user_id
     * @return importance different importance color schemas including the default one
     */
    protected function get($user_id){
        $sql = 'SELECT * FROM importance WHERE user_id=? OR user_id IS NULL ';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        $results = $stmt->fetchAll();

        return $results;

    }
    
    /**
     * update
     *
     * @param  Integar $id id of the record
     * @param  String $eimportant extremely important column
     * @param  String $vimportant very important column
     * @param  String $imporant   important column
     * @param  String $limportant less important column
     * @param  String $normal     normal column
     * @return String  States if the update is success or not
     */
    protected function update($id,$eimportant,$vimportant,$imporant,$limportant,$normal){
        $sql = 'UPDATE importance SET extremely_important=?,very_important=?,important=?,less_important=?,normal=? WHERE id=?';

        $stmt = $this->conn->prepare($sql);
        
        try{
            $stmt->execute([$eimportant,$vimportant,$imporant,$limportant,$normal,$id]);
            
            echo 'Importance was updated successfully';
            
        }catch(PDOException $e){
            echo 'Update failed!';
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    /**
     * getById get the schema by id
     *
     * @param  Integar $schema_id Schema ID
     * @return AssocArray
     */
    protected function getById($schema_id){
        $sql = 'SELECT * FROM importance WHERE id=? ' ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$schema_id]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    /**
     * destroy
     *
     * @param  Integar $id
     * @return String  States if the delete is success or not
     */
    protected function destroy($id){
        $sql = 'DELETE FROM importance WHERE id=?';

        $stmt = $this->conn->prepare($sql);
        
        try{
            $stmt->execute([$id]);
            
            echo 'Importance was deleted successfully';
        }catch(PDOException $e){
            echo 'Delete failed!';
            echo 'Error: ' . $e->getMessage();
        }
    }
}