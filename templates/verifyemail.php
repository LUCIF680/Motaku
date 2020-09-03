<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Email || MasterOtaku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://lucif680.github.io/images/masterotaku/favicon.jpg">
    <link rel="stylesheet" href="templates/view/css/verifyemail.css">
    <link rel="stylesheet" href="templates/view/css/responsive/loginsignup.css">
</head>
<body>
<div class="container">
    <a href="<?php echo $var['back']?>"><span>Back</span></a>
    <p>Please Verify your Email</p>
    <form action="<?php echo $action?>" method="post">
        <input type="text" id="otp" placeholder="ENTER OTP" name="<?php echo $_SESSION['name']['otp']?>" required >
        <?php echo "<br><span style='color:red;font-size:80%'>Email may take 2-3 mins to arrive.".$msg."<br>Verification Code has been send to ".$_SESSION['user']['email']."<br/>Please Check your SPAM folder also</span>"?>
        <div id="error"></div>
        <div align="center">
            <br/><button type="submit">Submit</button>
        </div>
    </form>
</div>
</body>
</html>