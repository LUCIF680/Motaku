<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register || Motaku</title>
    <!--Meta Information
        ================================================== -->
    <meta name="Description" content="Write your own article and share with friends, family.">
    <meta name="keyword" content="anime,manga,one piece,zoro,luffy,kaido,naruto,bnha,boku no hero,tokyo ghoul,top 10,blog,recommend">
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
    <a href="login"><span>Sign In</span></a>
    <span>MasterOtaku</span>
    <p>Register With us</p>
    <p>-----------------</p>
    <form action="<?php echo $action?>" method="post" >
        <input type="text" placeholder="Your Name"  name="<?php echo $_SESSION['name']['name']?>">
        <input type="email" placeholder="Your Email Address"  name="<?php echo $_SESSION['name']['email']?>"  >
        <input type="password" placeholder="Enter Password" name="<?php echo $_SESSION['name']['password']?>">
        <input  type="password" placeholder="Confirm Password" name="<?php echo $_SESSION['name']['con_password']?>">
        <br/>
        <div style="color:red" id="error">
        </div>
        <?php echo $msg?>
        <div align="center">
            <button type="submit" onclick="">Sign Up</button>
        </div>
    </form>
</div>
</body>
</html>
