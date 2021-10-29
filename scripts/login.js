$(function(){
    

    // VALIDATE THE INPUT
    $("#login-form").validate({
        
        rules: {

            email:{
                required:true,
                email:true
            },
            password:{
                required:true,
                minlength:8,
                maxlength:32
            }

        
    }})




    
    //AJAX CALL TO LOGIN THE USER
    $("body").on('submit',"#login-form",
    function (e){
        e.preventDefault()
       if(!($(".error").length >0)){
        var values = $(this).serialize()
        $.ajax({
            url:"./services/login.php",
            type:"post",
            data:values,
            success:function(res){
                if(res){
                    window.location.href="./"
                    
                }else{
                    $("#unverified").html("Email address or password is wrong please try again!")
                    setTimeout(function(){
                        $("#unverified").html("")
                    },6000)
                }
            }
        })
       }
    }
    
    )
  
   
})