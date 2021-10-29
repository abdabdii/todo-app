<?php include("header.php") ?>
    <link rel="stylesheet" href="styles/register.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>LOGIN</title>
</head>
<body>
        <div id="unverified" style="color:red;font-size:15px;margin-bottom:15px;"></div>
        <form class='register-form' id="login-form" >
        
        
        <div class="flex-row">
            <label class="lf--label" for="email">
            <i class="fas fa-envelope"></i>
            </label>
            <input id="email" class='lf--input' name="email" placeholder='Email address' type='email'>
        </div>
        <div class="flex-row">
            <label class="lf--label" for="password">
            <i class="fas fa-lock"></i>
            </label>
            <input id="password" class='lf--input' name="password" placeholder='Password' type='password'>
        </div>
        
        <input class='lf--submit' type='submit' value='LOGIN'>
        </form>
        <p>Don't have an account yet? <a class='lf--forgot' href='./register.php'>Register Now</a></p>
    

        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="./scripts/login.js"></script>
</body>
</html>