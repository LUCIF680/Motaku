<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset || MasterOtaku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://lucif680.github.io/images/masterotaku/favicon.jpg">
    <link rel="stylesheet" href="templates/view/css/login.css">
    <link rel="stylesheet" href="templates/view/css/responsive/loginsignup.css">
</head>
<body>
<div class="container">
    <a href="home">
        <span>Home</span></a>
    <span>MasterOtaku</span>
    <p>Let's get you into your account</p>
    <p>Tell us Sign-in email address to get started:</p>
    <form action="<?php echo $action?>" method="post">
        <input type="email" name="<?php echo $_SESSION['name']['email']?>" placeholder="Your Email" required /><br/>
        <div class="error"><?php echo $msg?></div>
        <button type="submit" value="Continue">Submit</button>
    </form>
</div>
<script src="templates/js/recovery.js"></script>
</body>
</html>