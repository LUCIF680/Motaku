<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Change Your Password </title>
    <!-- mobile specific metas
        ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- favicons
    ================================================== -->
    <link rel="icon" href="https://lucif680.github.io/images/masterotaku/favicon.jpg">
    <link rel="stylesheet" href="templates/view/css/verifyemail.css">
</head>
<body>
<div class="container">
    Change Password<br/><br/>
    <form action="<?php echo $action?>" method="post">
        <?php
        if(isset($_SESSION['user']['login']))
            echo '<input type="password" id="old_pass" class="password" name='.$_SESSION['name']["old_password"].' placeholder="Enter Old Password"/>';
        ?>
        <input type="password" id="pass" class="password" name="<?php echo $_SESSION['name']['new_password']?>" placeholder="Enter New Password"/>
        <input type="password" id="con_pass" class="password" name="<?php echo $_SESSION['name']['con_password']?>" placeholder="Confirm Password"/>
        <br><?php echo $msg;?><br>
        <div style="color:red" id="error"></div><br>
        <div align="center">
            <button type="submit">Change</button>
        </div>
    </form>
</div>
<script src="templates/js/changepassword.js"></script>
</body>
</html>
