<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/config/Database.php');

Class Todos extends Database{
    
    
        
    /**
     * create TODO
     *
     * @param  String  $todo todo task
     * @param  Integar $user_id 
     * @param  Integar $status 1 for finished 0 for not finished
     * @param  Integar $importance decides the degree of importance
     * @return String  States if the insert is success or not
     */
    protected function create($todo,$user_id,$status,$importance){
        $sql = 'INSERT INTO todos (content,user_id,status,importance) VALUES (?,?,?,?)';
        $stmt = $this->conn->prepare($sql);
        
        try{
            $stmt->execute([$todo,$user_id,$status,$importance]);
            return true;
        }catch(PDOException $e){
            echo 'Insert failed!';
            echo 'Error: ' . $e->getMessage();
        }
       
    }
    

    /**
     * get
     * @param Integar $user_id
     * @return todos
     */
    protected function get($user_id){
        $sql = 'SELECT * FROM todos WHERE user_id=? ' ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

            
    /**
     * Get todo by ID
     *
     * @param  Integar $todoId todo id
     * @return Todo returns the todo
     */
    protected function getById($todoId){
        $sql = 'SELECT * FROM todos WHERE id=? ' ;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$todoId]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    /**
     * find
     *
     * @param  String $searchValue
     * @return todos
     */
    protected function find($searchValue){
        $sql = 'SELECT * FROM todos WHERE REGEXP_LIKE(todo,?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$searchValue]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

              
    /**
     * update
     *
     * @param  Integar $id id of the todo
     * @param  String $updateValue new value for the todo
     * @param  Integar $status whether it is finished or not
     * @param  Integar $importance decides the degree of importance
     * @return todo
     */
    protected function update($id,$updateValue,$status,$importance){
        $sql = 'UPDATE todos SET content=? , status=? , importance=? WHERE id=?';
        $stmt = $this->conn->prepare($sql);

        try{
            $stmt->execute([$updateValue,$status,$importance,$id]);

            echo 'Todo was updated successfully';
        } catch(PDOException $e){
            echo 'Update failed!';
            echo 'Error: ' . $e->getMessage();
        }
        
    }


    /**
     * destroy
     *
     * @param  Integar $id id of the todo
     * @return String true for successfully deleted flase for failure
     */
    protected function destroy($id){
        $sql  = 'DELETE FROM todos WHERE id=?';
        $stmt = $this->conn->prepare($sql);

        try{
            $stmt->execute([$id]);

            echo 'Todo was deleted successfully';
        }catch(PDOException $e){
            echo 'Delete failed!';
            echo 'Error: ' . $e->getMessage();
        }
    }

}