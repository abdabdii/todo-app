<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header('Location: ./login.php');
    exit;
}
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/views/User.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/views/Todo.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/views/Importance.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/phpOOP/controllers/Importance.php');

$usersView = new UsersView();
$todosView = new TodosView();
$schemasView = new ImportancesView();
$usersController = new ImportancesController();

if(!isset($_COOKIE['schema'])){
    $schema = $usersController->getSchemaById(2);
    
    array_pop($schema);
    $schemaId = array_shift($schema);
    $cname = "schema";
    $cvalue = "".$schemaId."&".implode('&',$schema)."";
    setcookie($cname, $cvalue, time() + (86400 * 30), "/");
}

$user_id = $_SESSION["user_id"];





?>
    <?php include("header.php") ?>
    

    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" integrity="sha512-6qkvBbDyl5TDJtNJiC8foyEVuB6gxMBkrKy67XpqnIDxyvLLPJzmTjAj1dRJfNdmXWqD10VbJoeN4pOQqDwvRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Todo App</title>
</head>
<body>
    <div class="container">
        <!--   HEADER SECTION START  -->
        
            <header>
                <nav class="navbar">
                    <div class="logo"><img src="assets/TODOS.svg" alt="logo"></div>
                    <div class="btns">
                        <?php  $usersView->getUserName($user_id); ?>
                        <button class="logout-btn"><p>Logout</p></button>
                    </div>
                </nav>
            </header>
        <!--   HEADER SECTION END  -->

        <!--   IMPORTANCE SECTION START  -->
            <div class="importance">
                <div class="color" >
                    <p>Extremely Important</p>
                    <div data-type="5"></div>
                </div>
                <div class="color" >
                    <p>Very Important</p>
                    <div data-type="4"></div>
                </div>
                <div class="color" >
                    <p>Important</p>
                    <div data-type="3"></div>
                </div>
                <div class="color" >
                    <p>Less Important</p>
                    <div data-type="2"></div>
                </div>
                <div class="color" >
                    <p>Normal</p>
                    <div data-type="1"></div>
                </div>
            </div>
        <!--   IMPORTANCE SECTION END  -->

        
        <!-- ADD NEW TODO SECTION START  -->
        <form class="add-todo" id="todo-form">
            <div class="title">
                <h4>ADD NEW TODO</h4>
                <a href="#colors-modal" rel="modal:open" class="color-btn" id="color-btn"><img src="./assets/color-circle.png" width="50px" height="50px" alt="colors-palete"></a>

            </div>
        <div class="form__group field">
            <input type="input" class="form__field" placeholder="todo" name="todo" id='todo' required />
            <label for="todo" class="form__label">Todo</label>
        </div>


        <div class="chosen-wrapper chosen-wrapper--style2" data-js="custom-scroll">
            <select class="chosen-select"  id="select-importance" name="select-importance">
                <option value="5" selected="selected">Extremely Important</option>
                <option value="4">Very Important</option>
                <option value="3">Important</option>
                <option value="2">Less Important</option>
                <option value="1">Normal</option>
            </select>
        </div>
        <button type="submit" >CREATE</button>

            
        </form>
        
        <!-- ADD NEW TODO SECTION END  -->

        <!--   SORTING SECTION START  -->
        <div class="sort-container">
                
                <p class="sort-text">SORT BY IMPORTANCE</p>
                <div class="radio-container">
                    <label class="radio">
                        <input type="radio" name="sort" value="desc" checked>
                        <span>descending</span>
                    </label>
                    <label class="radio">
                        <input type="radio" name="sort" value="asec">
                        <span>ascending</span>
                    </label>
                </div>
        </div>
        <!--   SORTING SECTION END  -->

        <!--   TODOS LISTING SECTION START  -->
        <div class="todos-container" id="todos-container">
            <?php $todosView->getTodos($user_id) ?>
        </div>

        <!--   TODOS LISTING SECTION END  -->






        
    </div>

    <!-- Modal Section START -->
    <div id="colors-modal" class="modal">
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Select')" id="defaultOpen">Select</button>
            <button class="tablinks" onclick="openTab(event, 'Create')">Create</button>
        </div>

        <div id="Select" class="tabcontent select-div">
        <?php $schemasView->getSchemas($user_id); ?>
        </div>

        <div id="Create" class="tabcontent create-div">
            <div class="create-div-input"><label for="e-important">Extremely Important</label><input type="color" name="e-important" id="e-important"></div>
            <div class="create-div-input"><label for="v-important">Very Important</label><input type="color" name="v-important" id="v-important"></div>
            <div class="create-div-input"><label for="important">Important</label><input type="color" name="important" id="important"></div>
            <div class="create-div-input"><label for="l-important">Less Important</label><input type="color" name="l-important" id="l-important"></div>
            <div class="create-div-input"><label for="normal">Normal</label><input type="color" name="normal" id="normal"></div>
            <button id="create-schema" class="schema-btn">Create Schema</button>
        </div>
    </div>
    <!-- Modal Section END -->




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js" integrity="sha512-zMfrMAZYAlNClPKjN+JMuslK/B6sPM09BGvrWlW+cymmPmsUT1xJF3P4kxI3lOh9zypakSgWaTpY6vDJY/3Dig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="./scripts/selectbox.min.js"></script>
    <script src="./scripts/index.js"></script>
    
</body>
</html>