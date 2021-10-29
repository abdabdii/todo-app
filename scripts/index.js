/* Ripple Effect for material design button START*/

function createRipple(event) {
    const button = event.currentTarget;
  
    const circle = document.createElement("span");
    const diameter = Math.max(button.clientWidth, button.clientHeight);
    const radius = diameter / 2;
  
    circle.style.width = circle.style.height = `${diameter}px`;
    circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
    circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
    circle.classList.add("ripple");
  
    const ripple = button.getElementsByClassName("ripple")[0];
  
    if (ripple) {
      ripple.remove();
    }
  
    button.appendChild(circle);
  }
  
  document.querySelector("button[type='submit']").addEventListener("click",createRipple)

/* Ripple Effect for material design button END*/


/**TABS SCRIPT  START*/

function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

/**TABS SCRIPT  END*/



function schemaSettings(){
  var colorCookieArr = getCookie("schema").split("%26")
  var schemaId = colorCookieArr[0]
  
  selectSchemaMenu(schemaId)
  setSchemaDiv(colorCookieArr[1],colorCookieArr[2],colorCookieArr[3],colorCookieArr[4],colorCookieArr[5])
  setTodoSchema(colorCookieArr[1],colorCookieArr[2],colorCookieArr[3],colorCookieArr[4],colorCookieArr[5])
}


function setColorDiv(element,color){
  $(element).css("background-color","#"+color)

}

function setBorderColor(element,color){
  $(element).css("border-left-color","#"+color)
}

function setSchemaDiv(eimportant,vimportant,important,limportant,normal){
  var eimportantDiv = $("[data-type=5]")
  var vimportantDiv = $("[data-type=4]")
  var importantDiv = $("[data-type=3]")
  var limportantDiv = $("[data-type=2]")
  var normalDiv = $("[data-type=1]")

  var divSettings = [[eimportantDiv,eimportant],[vimportantDiv,vimportant],[importantDiv,important],[limportantDiv,limportant],[normalDiv,normal]] 

  divSettings.forEach(function(item){
    setColorDiv(item[0],item[1])
  })
  

}

function setTodoSchema(eimportant,vimportant,important,limportant,normal){
  var eimportantTodo = $("[todo-importance=5]")
  var vimportantTodo = $("[todo-importance=4]")
  var importantTodo = $("[todo-importance=3]")
  var limportantTodo = $("[todo-importance=2]")
  var normalTodo = $("[todo-importance=1]")

  var todoSettings = [[eimportantTodo,eimportant],[vimportantTodo,vimportant],[importantTodo,important],[limportantTodo,limportant],[normalTodo,normal]] 

  todoSettings.forEach(function(item){
    setBorderColor(item[0],item[1])
  })


}


function selectSchemaMenu(id){
  $(".schema").removeClass("selected")
  $("[schema-id="+id+"]").addClass("selected")
}

function makeCookieValue(id,eimportant,vimportant,important,limportant,normal){
  return id+"%26"+eimportant+"%26"+vimportant+"%26"+important+"%26"+limportant+"%26"+normal
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i=0; i<ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1);
      if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
  }
  return "";
}

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


const rgb2hex = (rgb) => `#${rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/).slice(1).map(n => parseInt(n, 10).toString(16).padStart(2, '0')).join('')}`




function sortData(selector, attrName , sortType='desc') {
  return $($(selector).toArray().sort(function(a, b){
      var aVal = parseInt(a.getAttribute(attrName)),
          bVal = parseInt(b.getAttribute(attrName));
          if(sortType=="asec"){
            return aVal - bVal
          }else{
            return bVal - aVal;
          }
  }));
}





function sortTodos(){
  var sortType = $('input[name="sort"]:checked').val()
  var sortedTodos = sortData('.todo','todo-importance',sortType)
  $(".todos-container").html(sortedTodos)
}


/* CRUD OPERATIONS FOR TODO START */

function createTodo(){
  var todoText = $("#todo-form").serializeArray()[0].value
  var importance = $("#todo-form").serializeArray()[1].value
  if(todoText.length <1){
    $("#todo").css("border-bottom-color","red")
    setTimeout(() => {
      $("#todo").css("border-bottom-color","")
    }, 2500);
  }else{
    $.ajax({
      url:"./services/index.php",
      data:{"select-importance":importance,todo:todoText,operation:"insert"},
      type:"post",
      success:function(res){
        if(!res.includes('Insert failed!')){
          $(".todos-container").append(res)
          $("#todo").val("")
          schemaSettings()
      }else{
          alert("Couldn't add the todo")
      }
      }
    })
  }
}


function completeTodo(e){
  var todoId = $(e.target).parent().parent().parent().attr("todo-id")
  $.ajax({
    url:"./services/index.php",
    data:{id:todoId,operation:"complete"},
    type:"post",
    success:function(res){
      if(res.includes("successfully")){
        $(e.target).parent().parent().parent().remove()
      }
    
    }
  })
}


function deleteTodo(e){
  var todoId = $(e.target).parent().parent().parent().attr("todo-id")
  $.ajax({
    url:"./services/index.php",
    data:{id:todoId,operation:"delete"},
    type:"post",
    success:function(res){
      if(res.includes("successfully")){
        $(e.target).parent().parent().parent().remove()
      }
    }
  })
}

/* CRUD OPERATIONS FOR TODO END */



/* CRUD OPERATIONS FOR SCHEMAS START */

function createSchema(){
  var eimportant = $("input[name='e-important']").val().substring(1)
  var vimportant = $("input[name='v-important']").val().substring(1)
  var important = $("input[name='important']").val().substring(1)
  var limportant = $("input[name='l-important']").val().substring(1)
  var normal = $("input[name='normal']").val().substring(1)

  $.ajax({
    url:"./services/index.php",
    data:{eimportant,vimportant,important,limportant,normal,operation:'insert-schema'},
    type:"post",
    success:function(res){
      if(!res.includes('Insert failed!')){
        $("#Select").append(res)
        var id =$(res).attr("schema-id") 
        var cookieValue  = makeCookieValue(id ,eimportant,vimportant,important,limportant,normal)
        setCookie("schema",cookieValue,30)
        schemaSettings()
    }else{
        alert("Couldn't add the todo")
    }
    }
  })
}


function deleteSchema(e){
  var schemaId = $(e.target).parent().parent().parent().attr("schema-id")
  $.ajax({
    url:"./services/index.php",
    data:{id:schemaId,operation:"delete-schema"},
    type:"post",
    success:function(res){
      if(res.includes("successfully")){
        $(e.target).parent().parent().parent().remove()
        $("div[schema-id='1'] div[data-importance='5']").trigger("click")
      }
    }
  })
}






/* CRUD OPERATIONS FOR SCHEMAS END */

function getSchemaImportance(element,importance){
  return rgb2hex($(element).find("[data-importance='"+importance+"']").css("background-color")).substring(1)
}


// ,vimportant,important,limportant,normal
// 
function selectSchema(e){
  var element = $(e.target).parent()
  var eimportant = getSchemaImportance(element,5)
  var vimportant = getSchemaImportance(element,4)
  var important = getSchemaImportance(element,3)
  var limportant = getSchemaImportance(element,2)
  var normal = getSchemaImportance(element,1)
  var id = $(e.target).parent().parent().attr("schema-id")
  var cookieValue  = makeCookieValue(id ,eimportant,vimportant,important,limportant,normal)
  setCookie("schema",cookieValue,30)
  schemaSettings()

}



function logout(){
  $.ajax({
    url:"./services/index.php",
    type:"post",
    data:{operation:"logout"},
    success:function(){
      location.reload()
    }
  })
}






$(function(){
  schemaSettings()
  document.getElementById("defaultOpen").click();

  $("#todo-form").submit(function(e){
    e.preventDefault();
    createTodo()
    sortTodos()
  })
 
  $("#todos-container").off("click" ,".delete-todo",deleteTodo).on("click" ,".delete-todo",deleteTodo)
  $("#todos-container").off("click" ,".done-todo",completeTodo).on("click" ,".done-todo",completeTodo)
  $("input[name='sort']").change(function(){sortTodos()})


  $("#Select").off("click" ,".delete-schema",deleteSchema).on("click" ,".delete-schema",deleteSchema)
  $("#Create").off("click" ,"#create-schema",createSchema).on("click" ,"#create-schema",createSchema)
  $("#Select").off("click" ,".colors-schema",selectSchema).on("click" ,".colors-schema",selectSchema)
  $(".logout-btn").click(logout)
  

 
 
})


