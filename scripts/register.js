$(function(){
    

    // VALIDATE THE INPUT
    $("#register-form").validate({
        
        rules: {
            username:{
                required:true,
                minlength:5,
                maxlength:32
            },
            email:{
                required:true,
                email:true
            },
            password:{
                required:true,
                minlength:8,
                maxlength:32
            },
            confirm_password:{
                required:true,
                minlength:8,
                maxlength:32,
                equalTo:"#password"
            }
        },
        submitHandler:function(form){
            $.ajax({
                url:"./services/register.php",
                type:"post",
                data:$(form).serialize(),
                success:function(res){
                    if(!res.includes('Insert failed!')){
                        window.location.href="./"
                        
                    }else{
                        alert("Email address already exists please enter another email")
                    }
                }
            })
        }
        
    })



   
})