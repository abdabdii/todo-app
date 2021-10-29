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
        }
        
    })


    //AJAX CALL TO REGISTER THE USER
    $("body").on('submit',"#register-form",
    function(e){
        e.preventDefault()
       if(!($(".error").length >0)){
        var values = $(this).serialize()
        $.ajax({
            url:"./services/register.php",
            type:"post",
            data:values,
            success:function(res){
                if(!res.includes('Insert failed!')){
                    window.location.href="./"
                    
                }else{
                    alert("Email address already exists please enter another email")
                }
            }
        })
       }
    }
    
    )

   
})