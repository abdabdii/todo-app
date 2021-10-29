<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/models/Todos.php');

class TodosView extends Todos{
    
    /**
     * makeTodo Echos the todo
     *
     * @param  AssocArray $todo todo associative array
     * @return void
     */
    protected function makeTodo($todo){
        if($todo["status"]==0){
            echo '
        <div class="todo" todo-importance="'.$todo["importance"].'" status="'.$todo["status"].'" todo-id="'.$todo["id"].'">
            <p>'.$todo["content"].'</p>
            <div class="operations-container">
                <button class="done done-todo" ><i class="fas fa-check done"></i></button>
                <button class="delete delete-todo"><i class="far fa-trash-alt delete"></i></button>
                
            </div>
        </div>
    ';
        }
    }
        
    /**
     * Get todo view
     *
     * @param  Integar $id Todo Id
     * @return void
     */
    public function getTodoById($id){
        $todo = $this->getById($id);
        $this->makeTodo($todo[0]);
    }
    
    /**
     * getTodos gets all todos of user and returns the view
     *
     * @param  Integar $user_id
     * @return void
     */
    public function getTodos($user_id){
        $todos = $this->get($user_id);
        foreach ($todos as $todo){
            $this->makeTodo($todo);
        }
    }


}
