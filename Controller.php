<?php
require_once 'library/php/SQNile.php';
require_once 'library/php/Itari.php';
require_once "Modal.php";
require_once 'library/php/Mail.php';
require_once 'library/php/File.php';
class Controller extends Modal implements Constants{
    function search($requestGET){
                $this->setDatabaseInfo('masterotaku');
                $searchInput = $this->trimInput($requestGET['search']);
                $searchInput = strtolower($searchInput);
                $searchInput = $this->parseSearch($searchInput);
                $result = [];
                foreach ($searchInput as $keyword)
                    array_push($result,$this->fetchAll("SELECT * FROM files WHERE MATCH(tags) AGAINST (?)",[$keyword]));
                $result = $result[0];
                $result['searchInput'] = $requestGET['search'];
                $this->loadTemplate('search',$result);
    }
    function showBlog($requestGET){
                $this->setRedirect($requestGET['path']);
                $blog_id = $requestGET['id'][0];
                try {
                    $blog = $this->getBlogById($blog_id);
                    $blog['title'] = $this->addSpace($blog['title']);
                    $blog['blogContent'] = $this->addSpace($blog['blogContent']);
                    $blog['tags'] = $this->addSpace($blog['tags']);
                    $array = $blog;
                    $this->setDatabaseInfo("masterotaku");
                    $array['popularBlogs'] = $this->fetchAll("SELECT * FROM files ORDER BY views DESC LIMIT 4");
                    for($i = 0; $i < count($array['popularBlogs']); $i++)
                        $array['popularBlogs'][$i]['title'] = $this->addSpace($array['popularBlogs'][$i]['title']);
                    $this->query("UPDATE files SET views = ? WHERE id = ? ",[$blog['views']+1,$blog['id']]);
                    $this->setDatabaseInfo('itarimusic');
                    // Changing #manga#anime#one piece to manga,anime
                    $array["keywordString"] = substr($array['tags'],1);
                    $array["keywordString"] = str_replace("#",",",$array["keywordString"]);
                    $this->loadTemplate('blog',$array);
                }catch(Exception $e){$this->redirect('404');}
    }
   function getNextPrev($responseGET){
                $this->setDatabaseInfo('masterotaku');
                $response = [];
                $total_blogs = $this->fetch("SELECT id FROM files ORDER BY ID DESC LIMIT 1");
                for($i = 0; $i < 2;$i++){
                    $random = mt_rand(100000,999999);
                    $random = floor($random/10);
                    $random = (string)$random;
                    switch ($total_blogs['id']){
                        case $total_blogs['id'] < 10 && $total_blogs['id'] > 1:
                            $random = substr($random,0,1);
                            break;
                        case $total_blogs['id'] < 100 && $total_blogs['id'] > 10:
                            $random = substr($random,0,2);
                            break;
                        case $total_blogs['id'] < 1000 && $total_blogs['id'] > 100:
                            $random = substr($random,0,3);
                            break;
                        case $total_blogs['id'] < 10000 && $total_blogs['id'] > 1000:
                            $random = substr($random,0,4);
                            break;        
                        default:
                            die();    
                    }
                    if ($random == $responseGET['current_id'] || $random > $total_blogs['id'])
                        $i--;
                    else{
                        $title = $this->fetch("SELECT title FROM files WHERE id = ?",[$random]);
                        $title['title'] = $this->addSpace($title['title']); 
                        array_push($response,$title['title']);
                        array_push($response,$random);
                    }
                }
                echo json_encode($response);
    }
    function home(){
                session_start();
                $allBlogsInfo = $this->getHomeBlog();
                $this->setRedirect('403.shtml');
                $this->loadTemplate('home',[$allBlogsInfo]);
                session_commit();
    }
    function fetchUser(){
                session_start();
                if (isset($_SESSION['user']['login'])) {
                    $this->flushTemp();
                }
                function loggedInState(){
                    if (!isset($_SESSION['user']['login']) && (isset($_COOKIE['ref']))) {
                        $database = new SQNile();
                        $id_refid = $database->fetch("SELECT id,ref_id FROM online WHERE refrence = ?", [$_COOKIE['ref']]);
                        $user = $database->fetch("SELECT * FROM users WHERE id = ?", [$id_refid['id']]);
                        unset($database);
                        $_SESSION['user'] = $user;
                        $_SESSION['user']['reference'] = $_COOKIE['ref'];
                        $_SESSION['user']['ref_id'] = $id_refid['ref_id'];
                        $_SESSION['user']['login'] = true;
                        return true;
                    } else if (isset($_COOKIE['ref']) && (isset($_SESSION['user']))) {
                        //if user has already visited other page than no need to connect to database
                        if (($_COOKIE['ref'] == $_SESSION['user']['reference'])) {
                            $_SESSION['user']['login'] = true;
                            return true;
                        }
                    } else {
                        return false;
                    }
                }
                    if (loggedInState())
                        echo '<a href="#"><span class="menu_div">' . $_COOKIE["name"] . '</span></a> <a href="logout"><span class="menu_div">Log Out</span></a>';
                    else // if user is visiting the page first time
                        echo '<a href="signup"><span class="menu_div">Sign Up</span></a> <a href="login"><span class="menu_div">Log In</span></a>';
               session_commit();
    }
    function login(){
                $msg = $this->destroySessionWithMsg();
                session_start();
                $_SESSION['name'] = array('email'=>$this->randomString(23),"password"=>$this->randomString(23));
                $_SESSION['name']["encode"] = $this->randomString(11);
                $_SESSION['encodeValue'] = $this->encode();
                $this->loadFormTemplate("login",["msg" => $msg,"action_php"=>"checklogin"]);
                session_commit();
    }
    function checkLoginInfo($requestGET,$requestPOST){
                session_start();
                if (isset($_SESSION['user']['login']))
                    $this->redirect('403.shtml');
                /*  checking if user is authorized to read checkUser.php
                    ===============================================*/
                if (($this->checkServer($requestGET) == false ) || ($this->decode($requestGET[$_SESSION['name']["encode"]])) == false) {
                    $this->setMsg("Please Try again");
                    $this->redirect('login');
                }/*  ==========================
            getting users information*/
                $email = $requestPOST[$_SESSION['name']['email']];
                $password = $requestPOST[$_SESSION['name']['password']];
                /*  ==========================
                   Validating user's email*/
                if (!filter_var($email, FILTER_VALIDATE_EMAIL) ||$email == "") {
                    $_SESSION['msg'] = "Wrong Email Format";
                    $this->redirect('login');
                }
                /*  ===========================
                    Checking user is authorized login */
                $user= $this->fetch("SELECT name,password,email,id,paid_user FROM users WHERE email = ?",[$email]);
                if (($user['email'] == $email)&&(password_verify($password, $user['password']))){
                    /*  user is authorized
                        ======================*/
                    $this->setCookieName($user['name']);
                    $reference=$this->setReference();
                    $this->query("INSERT INTO online (refrence,ref_id,id) VALUES (?,?,?)",[$reference[0],$reference[3],$user['id']]);
                    $_SESSION['user'] = ['ref_id'=>$reference[3],'reference'=>$reference[0],
                        'name'=>$user['name'],'id'=>$user['id']];
                    setcookie('ref', $reference[0], time() + (86400 * 30));
                    setcookie('refral_irati', $reference[1], time() + (86400 * 30));
                    setcookie('refral', $reference[2], time() + (86400 * 30));
                    $_SESSION['user']['login'] = true;
                    unset($_SESSION['name']);
                    $this->redirect($this->getRedirect());// will redirect to asked login page
                }else {
                    unset($_SESSION['name']);
                    $_SESSION['msg'] = "Invalid Password or Email Address";
                    $this->redirect('login');
                }
    }
    function edit(){
                session_start();
                
                    $this->setRedirect("edit");
                    $array = ["action_php"=>"addblog" , "msg"=>$this->getMsg()];
                    $_SESSION['name'] = ["thumbnail"=>$this->randomString(11),"hidden"=>$this->randomString(11),
                        "image"=>$this->randomString(11),"title"=>$this->randomString(11),
                        "blog"=>$this->randomString(11),"tags"=>$this->randomString(11),
                        "video"=>$this->randomString(11),"encode"=>$this->randomString(11)];
                    $_SESSION["encodeValue"] = $this->encode();
                    $this->loadFormTemplate('edit',$array);
                
                session_commit();
    }
    function filepondUpload(){
                session_start();
                $file = new File();
                if(isset($_SESSION['name']['image'])) {
                    if (isset($_FILES[$_SESSION['name']['image']])) {
                        if ($file->imageConstrains($_FILES[$_SESSION['name']['image']]))
                            $file->uploadFile($_FILES[$_SESSION['name']['image']], Constants::IMAGE);
                        echo $file->getImageName();
                    }
                }
                if(isset($_SESSION['name']['thumbnail'])) {
                    if (isset($_FILES[$_SESSION['name']['thumbnail']])) {
                        if ($file->imageConstrains($_FILES[$_SESSION['name']['thumbnail']]))
                            $file->uploadFile($_FILES[$_SESSION['name']['thumbnail']], Constants::THUMBNAIL);
                        $_SESSION['thumbnail'] = $file->getThumbnailName();
                    }
                }
                session_commit();
    }
    function addBlog($requestGET,$requestPOST){
                session_start();
                if (!isset($_SESSION['user']['login']))
                    $this->redirect('edit');
                /*  checking if user is authorized to read checkUser.php
                    ===============================================*/
                if ($this->checkServer($requestGET) == false) {
                    $_SESSION['msg'] = "Please Try again";
                    $this->redirect('edit');
                }
                try {
                    $title = $requestPOST[$_SESSION['name']['title']];
                    $tags = $requestPOST[$_SESSION['name']['tags']];
                    $tags = strtolower($tags);
                    $blogContent = $requestPOST[$_SESSION['name']['blog']];
                    if ($title == "" || $blogContent == "")
                        $this->redirect('edit');
                    $blogContent = $this->trimInput($blogContent);
                    $tags = $this->trimInput($tags);
                    $title = $this->trimInput($title);
                    $file = new File();
                    $_SESSION['image'] = urldecode($requestPOST[$_SESSION['name']['hidden']]);
                    $_SESSION['image'] = json_decode($_SESSION['image'],true);
                    $file->moveImages();
                    $this->flushTemp();
                    /*Saving all blog information to Database
                     =============================== */
                     $_SESSION['image'] = json_encode($_SESSION['image'],true);
                    $this->setDatabaseInfo('masterotaku');
                    $this->query(
                        "INSERT INTO files (images,blogContent,user_id,title,tags,views,thumbnail)
                         VALUES (?,?,?,?,?,?,?)",
                        [$_SESSION['image'],$blogContent,$_SESSION['user']['id'], $title, $tags,0,$file->getThumbnailName()]);
                    unset($_SESSION['name'],$_SESSION['thumbnail']);    
                    $this->setDatabaseInfo('itarimusic');
                    $this->loadTemplate('thankyou');
                } catch (Exception $e) {
                    $this->redirect('edit');
                }
    }
    function signup(){
                $msg = $this->destroySessionWithMsg();
                session_start();
                $_SESSION['encodeValue'] = $this->encode();
                $array = ["action_php"=>"verifyemail" , 'msg'=>$msg];
                $_SESSION['name'] = ["name"=>$this->randomString(11),"password" => $this->randomString(11),
                                    "con_password" => $this->randomString(11),"email" => $this->randomString(11),
                                    "encode" => $this->randomString(11)];
                $this->setRedirect('403.shtml');
                $this->loadFormTemplate('signup',$array);
                session_commit();
    }
    function verifyEmailPage($requestGET,$requestPOST){
                session_start();
                if (isset($_SESSION['user']['login']))
                    $this->redirect('403.shtml');
                if (isset($_SESSION['forget_pass']))
                    $errorRedirect = 'recovery';
                else
                    $errorRedirect = 'signup';
                /*  checking if user is authorized to read checkUser.php
                    ===============================================*/
                if (($this->checkServer($requestGET) == false ) || ($this->decode($requestGET[$_SESSION['name']['encode']])) == false) {
                    $this->setMsg("Please Try again");
                    //$this->redirect($errorRedirect);
                }
                if (isset($_SESSION['user']['email']))
                    $email = $_SESSION['user']['email'];
                else
                    $email = $requestPOST[$_SESSION['name']['email']];
                // Checking Email Address
                if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == "") {
                    $this->setMsg("Wrong Email Format");
                    //$this->redirect($errorRedirect);
                }
                $user = $this->fetch('SELECT * FROM users WHERE email = ?',[$email]);
                // Line 72 is for Wrong OTP
                if (isset($_SESSION['user']['email']) == false) {
                    /*If the post request is from Recovery
                         * ==================================*/
                    if (isset($_SESSION['forget_pass'])) {
                        if (empty($user)) {
                            $this->setMsg("Invalid Email Address");
                           // $this->redirect($errorRedirect);
                        }
                        $_SESSION['user']['email'] = $email;
                        $_SESSION['user']['id'] = $user['id'];
                        unset($_SESSION['name']['email']);
                    } else {
                        /*If the post request is from Sign up
                         * ==================================*/
                        if (empty($user) == false) {
                            $this->setMsg("Email Address Exists");
                           // $this->redirect('signup');
                        }
                        $name = $requestPOST[$_SESSION['name']['name']];
                        /*Checking Name and Password is in correct Format
                        ===================================*/
                        if ($this->checkName($name) == false)
                           // $this->redirect('signup');
                        $password = $requestPOST[$_SESSION['name']['password']];
                        $con_password = $requestPOST[$_SESSION['name']['con_password']];
                        if ($this->checkPassword($password, $con_password) == false) {
                           // $this->redirect('signup');
                        }
                        $_SESSION['user']['email'] = $email;
                        $_SESSION['user']['name'] = $this->trimInput($requestPOST[$_SESSION['name']['name']]);
                        $_SESSION['user']['password'] = password_hash($password, PASSWORD_BCRYPT, ['cost' => 11]);
                        unset($_SESSION['name'], $name, $password, $con_password, $_SESSION['name']['email']);
                    }
                }
                $msg = $this->getMsg(); // If user typed wrong OTP then set msg
                if (isset($_SESSION['forget_pass'])) {
                    $back = 'recovery';
                    $nextPage = "changepassword";
                }else{
                    $back = 'signup';
                    $nextPage = "registrationdone";
                }
                $mail = new Mail;
                if ($msg != "Wrong OTP")
                    $_SESSION['realotp'] = $mail->sendOTP($email, $errorRedirect);
                $_SESSION["online_time"] = time();
                $_SESSION['name']['otp'] = $this->randomString(11);
                $_SESSION['name']['encode'] = $this->randomString(11);
                $_SESSION['encodeValue'] = $this->encode();
                $array = ['back'=>$back ,"msg" => $msg, "encodeValue" => $_SESSION['encodeValue'], "action_php"=>$nextPage];
                $this->loadFormTemplate('verifyemail',$array);
                session_commit();
    }
    function registration($requestGET,$requestPOST){
                session_start();
                if (isset($_SESSION['user']['login']))
                    $this->redirect('403.shtml');
                /*  checking if user is authorized to read checkUser.php
                    ===============================================*/
                if ($_SESSION["online_time"] > time()+600){
                    $this->setMsg("Please submit the form with in 10 minutes");
                   // $this->redirect('signup');
                }
                if (($this->checkServer($requestGET) == false ) || ($this->decode($requestGET[$_SESSION['name']['encode']])) == false) {
                    $this->setMsg("Please Try again");
                   // $this->redirect('signup');
                }
                $_SESSION['name']['encode'] = $this->randomString(11);
                $_SESSION['encode'] = $this->encode();
                /*If OTP not matched
                =========================*/
                if ($requestPOST[$_SESSION['name']['otp']] != $_SESSION['realotp']) {
                    $this->setMsg('Wrong OTP');
                    //$this->redirect('verifyemail?'.$_SESSION['name']['encode'].'='.$_SESSION['encodeValue']);
                }
                $email = $_SESSION['user']['email'];
                $password = $_SESSION['user']['password'];
                $name = $_SESSION['user']['name'];
                session_destroy();
                session_commit();
                session_start();
                $this->query('INSERT INTO users (name,email,paid_user,password) VALUES (?,?,?,?)', [$name,$email,"false",$password ]);
                $user= $this->fetch("SELECT name,id FROM users WHERE email = ?",[$email]);
                $this->setCookieName($user['name']);
                $reference = $this->setReference();
                $this->query("INSERT INTO online (refrence,ref_id,id) VALUES (?,?,?)", [$reference[0], $reference[3], $user['id']]);
                $this->createUserTable($user['id']);
                $_SESSION['user'] = ['ref_id'=>$reference[3],'reference'=>$reference[0],
                                    'name'=>$user['name'],'id'=>$user['id']];
                setcookie('ref', $reference[0], time() + (86400 * 30));
                setcookie('refral_irati', $reference[1], time() + (86400 * 30));
                setcookie('refral', $reference[2], time() + (86400 * 30));
                $_SESSION['user']['login'] = true;
                /*Create DIR for every user 
                ==========================*/
                mkdir("blog/".$_SESSION['user']['id'] , 0755);
                mkdir("blog/".$_SESSION['user']['id']."/images" , 0755);
                mkdir("blog/".$_SESSION['user']['id']."/temp" , 0755);
                //$this->redirect($this->getRedirect());// will redirect to asked registration method
                session_commit();
    }
    function recovery(){
                $msg = $this->destroySessionWithMsg();
                session_start();
                $_SESSION["forget_pass"] = true;
                $_SESSION['name'] = ["email" => $this->randomString(11),"encode" => $this->randomString(11)];
                $_SESSION['encodeValue'] = $this->encode();
                $array = ["action_php"=>"verifyemail" , 'msg'=>$msg];
                $this->loadFormTemplate('recovery',$array);
                session_commit();
    }
    function changePassword($requestGET,$requestPOST){
                session_start();
                if (isset($_SESSION['user']['login'])) {
                    $_SESSION['name']['old_password'] = $this->randomString(11);
                    $errorRedirect = "changepassword";
                }else {
                    $errorRedirect = "recovery";
                    /*  checking if user is authorized to read checkUser.php
                        ===============================================*/
                    if ($_SESSION["online_time"] > time() + 600) {
                        $this->setMsg("Please submit the form with in 10 minutes");
                        $this->redirect($errorRedirect);
                    }
                    if (($this->checkServer($requestGET) == false) || ($this->decode($requestGET[$_SESSION['name']['encode']])) == false) {
                        $this->setMsg("Please Try again");
                        $this->redirect($errorRedirect);
                    }
                    /*Check Wether OTP matches
                    =========================*/
                    if ($requestPOST != "") {
                        if ($requestPOST[$_SESSION['name']['otp']] != $_SESSION['realotp']) {
                            $this->setMsg('Wrong OTP');
                            $this->redirect('verifyemail?' . $_SESSION['name']['encode'] . '=' . $_SESSION['encodeValue']);
                        }
                    }
                }
                $_SESSION['name']['encode'] = $this->randomString(11);
                $_SESSION['encodeValue'] = $this->encode();
                $msg = $this->getMsg();
                $_SESSION["online_time"] = time();
                $_SESSION['name']['new_password'] = $this->randomString(11);
                $_SESSION['name']['con_password'] = $this->randomString(11);
                $this->loadFormTemplate('changepassword',["action_php"=>"changeyourpassword","msg"=>$msg]);
                session_commit();
    }
    function changePasswordlogic($requestGET,$requestPOST){
                session_start();
                if (isset($_SESSION['user']['login'])) {
                    $old_password = $this->fetch("SELECT name,password,email,id,paid_user FROM users WHERE email = ?", [$_SESSION['user']['email']]);
                    if ($old_password != $requestPOST[$_SESSION['name']['encode']]) {
                        $this->setMsg('Old password is wrong');
                        $this->redirect('changepassword');
                    }
                    $errorRedirect = 'changepassword';
                }else
                    $errorRedirect = 'recovery';
                /*  checking if user is authorized to read checkUser.php
                    ===============================================*/
                if ($_SESSION["online_time"] > time()+600){
                    $this->setMsg("Please submit the form with in 10 minutes");
                    $this->redirect($errorRedirect);
                }
                if (($this->checkServer($requestGET) == false ) || ($this->decode($requestGET[$_SESSION['name']['encode']])) == false) {
                    $this->setMsg("Please Try again");
                    $this->redirect($errorRedirect);
                }
                if(isset($_SESSION['forget_pass'])) {
                    $new_password = $requestPOST[$_SESSION['name']['new_password']];
                    if ($this->checkPassword($new_password, $requestPOST[$_SESSION['name']['con_password']])) {
                        $enc_pass = password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 11]);
                        $this->query('UPDATE users SET password = ? WHERE email = ?', [$enc_pass, $_SESSION['user']['email']]);
                        $user = $this->fetch("SELECT name,password,email,id,paid_user FROM users WHERE email = ?", [$_SESSION['user']['email']]);
                        $this->setCookieName($user['name']);
                        $reference = $this->setReference();
                        $this->query("INSERT INTO online (refrence,ref_id,id) VALUES (?,?,?)", [$reference[0], $reference[3], $user['id']]);
                        session_destroy();
                        session_commit();
                        session_start();
                        $_SESSION['user'] = ['login'=>'true','ref_id' => $reference[3], 'reference' => $reference[0],
                            'name' => $user['name'], 'id' => $user['id']];
                        setcookie('ref', $reference[0], time() + (86400 * 30));
                        setcookie('refral_irati', $reference[1], time() + (86400 * 30));
                        setcookie('refral', $reference[2], time() + (86400 * 30));
                        $this->redirect($this->getRedirect());// will redirect to asked login page
                    }else
                        $this->redirect('changepassword?' . $_SESSION['name']['encode'] . '=' . $_SESSION['encodeValue']);
                }
    }
    function logout(){
                session_start();
                if (isset($_SESSION['user']['login'])){
                    $this->query("DELETE FROM online WHERE ref_id = ?",[$_SESSION['user']['ref_id']]);
                    session_destroy() ;
                    setcookie("name",$_COOKIE["name"],time()-100);
                    setcookie("ref","",time()-100);
                    setcookie("refral_irati","",time()-100);
                    setcookie("refral","",time()-100);
                    $this->redirect($this->getRedirect());
                } else
                    $this->redirect($this->getRedirect());
                session_commit();
    }
    function joinUs(){
                $this->setRedirect('edit');
                $this->loadTemplate('joinus');
    }
    function test(){
       echo password_hash("123456789",PASSWORD_BCRYPT);
        
    }
    function session(){
        session_start();
        print_r($_SESSION);
    }
    function notFoundError(){
        $this->loadTemplate('404');
    }
}