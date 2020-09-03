<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log In || OtakuMaster</title>
    <meta name="Description" content="Write your own article and share with friends, family.">
    <!-- mobile specific metas
        ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- favicons
    ================================================== -->
    <link rel="icon" href="https://lucif680.github.io/images/masterotaku/favicon.jpg">
    <link rel="stylesheet" href="templates/view/css/login.css">
    <link rel="stylesheet" href="templates/view/css/responsive/loginsignup.css">
    <script src="templates/js/main.js"></script>
    <script src="templates/js/login.js"></script>
</head>
<body>
<div class="container">
    <a href="signup"><span>Sign Up</span></a>
    <span>MasterOtaku</span>
    <p>Log In</p>
    <p>-----------------</p>
    <form action="<?php echo $action?>" method="post" >
        <input type="email" placeholder="Your Email Address"   name="<?php echo $_SESSION['name']['email']?>" required>
        <input type="password" placeholder="Enter Password"  name="<?php echo $_SESSION['name']['password']?>" required>
        <div class="error"><?php echo $msg?></div><br>
        <div align="center">
            <button type="submit">Log In</button>
        </div>
    </form><br>
    <a href="recovery">Forget Password?</a>
</div>
</body>
</html>