<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/models/Todos.php');

class TodosController extends Todos{
    
    /**
     * getTodoById get todo by id
     *
     * @param  Integar $id
     * @return AssocArray
     */
    public function getTodoById($todo_id){
        $todo = $this->getById($todo_id);
        return $todo[0];
    }
    
    /**
     * createTodo
     *
     * @param  String $todo todo content
     * @param  Integar $user_id id of the user who made the todo
     * @param  Integar $status 1 for done 0 for undone
     * @param  Integar $importance 1 to 5 value 1 for most important 5 for least important
     * @return Integar $id of the inserted todo
     */

    public function createTodo($todo,$user_id,$status,$importance){
        $this->create($todo,$user_id,$status,$importance);
        return $this->conn->lastInsertId();

    }
    
    
    /**
     * updateTodo
     *
     * @param  Integar $id id of the todo
     * @param  String $updateValue todo content
     * @param  Integar $status 1 for done 0 for undone
     * @param  Integar $importance 1 to 5 value 1 for most important 5 for least important
     * @return Bolean true for success
     */

    public function updateTodo($id,$updateValue,$status,$importance){
        $this->update($id,$updateValue,$status,$importance);
        return true;
    }

        
    /**
     * destroyTodo
     *
     * @param  Integar $id id of the todo
     * @return Bolean true for success
     */

    public function destroyTodo($id){
        $this->destroy($id);
        return true;
    }


}


//testing
// $todoCont = new TodosController();
// $todoCont->createTodo('My first todo ever' ,2 , 0 ,5);
// $todoCont->createTodo('My Second todo ever' ,2 , 0 ,3);
// $todoCont->createTodo('My Third todo ever' ,2 , 0 ,3);
// $todoCont->updateTodo(2,'Updated todo' ,1 ,2);
// $todoCont->destroyTodo(3);

