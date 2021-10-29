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

        
    },
    submitHandler:function (form){
        $.ajax({
            url:"./services/login.php",
            type:"post",
            data:$(form).serialize(),
            success:function(res){
                if(res!=="false"){
                    alert(res + "Scacs")
                    window.location.href="./"
                    
                }else{
                    $("#unverified").html("Email address or password is wrong please try again!")
                    setTimeout(function(){
                        $("#unverified").html("")
                    },6000)
                }
            }
        })
       return false;
    }


})




    
    
  
   
})