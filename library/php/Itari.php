<?php
trait Itari{
    function flushTemp(){
        $pathToDelete = sprintf('blog/%d/temp/*',$_SESSION["user"]["id"]);
        $files = glob($pathToDelete); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }
    }
    function checkServer($requestGET){
            if ($_SESSION['encodeValue'] == $requestGET[$_SESSION['name']['encode']])
                return true;
            else if (isset($_SERVER['HTTP_ORIGIN'])) {
                if ($_SERVER['HTTP_ORIGIN'] == 'http://localhost') {
                    header('Cache-Control: no-cache ');
                    return true;
                }
            } else if ($_SERVER['SERVER_NAME'] == 'localhost')
                return true;
            return false;
    }
    function checkPassword($password,$con_password,$old_password = "hi" ){
        if (($old_password == "") || ($password == "") || ($con_password == "")) {
            $_SESSION['msg'] = "Fill the form";
            return false;
        }
        else if (strlen($password) < 8) {
            $_SESSION['msg'] = "Password must be grater than 8 characters";
            return false;
        }
        else if ($password != $con_password) {
            $_SESSION['msg'] = "Password didn't match";
            return false;
        }
        return true;
    }
    public function checkName($name){
        $name_pattern = "/^[a-zA-Z ]*$/";
        if ($name == "") {
            $_SESSION['msg'] = "Fill the Form";
            return false;
        }
        else if (!preg_match($name_pattern,$name)) {
            $_SESSION['msg'] = "Name can only contain whitespaces and characters";
            return false;
        }
        return true;
    }
    function loadTemplate($template,$array=[]){
        require_once 'templates/'.$template.".php";
    }
    function redirect($location){
        session_commit();
        header('Location:'.$location);
        die($location);
    }
    function trimInput($data){
        $data = str_replace(" ","%20",$data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function setRedirect($currentPage){
        if (isset($_COOKIE['page']))
            setcookie('page',$currentPage,time() + (86400 * 30),"/masterotaku");
        else
            setcookie('page',$currentPage,time() + (86400 * 30),"/masterotaku");
    }
    function getRedirect(){
        return $_COOKIE['page'];
    }
    function getMsg(){
        if (isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            unset($_SESSION['msg']);
            return $msg;
        }
        else
            return "";
    }
    function setMsg($msg){
        $_SESSION['msg'] = $msg;
    }
    function startsWith($haystack, $needle){
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    function endsWith($haystack, $needle){
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }
        return (substr($haystack, -$length) === $needle);
    }
    function randomString($length, $keyspace = '-^*@!`0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces [] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
    function encode(){
        $data = $this->randomString(23);
        $time = str_split(time());
        foreach ($time as $timeChar){
            $random = $this->randomString(rand(10,43));
            $length = strlen($random);
            $data = $data . $length . $random. $timeChar;
        }
        return $data . 'a' .$this->randomString(23);
    }
    function decode($data){
        $decode = array();
        $data = substr($data,23);
        for ($i = 0;$i<=9;$i++) {
            $length = (int)substr($data, 0, 2);
            $data = substr($data, $length + 2);
            array_push($decode, substr($data, 0, 1));
            $data = substr($data, 1);
        }
        $data = substr($data, 0,1);
        array_push($decode, $data);
        $string = "";
        foreach($decode as $str){
            $string .= $str;
        }
        unset($decode,$data);
        $time = (int)substr($string,0,10);
        if ((($time+300) < (time())) ||((substr($string,10)) != "a"))
            return false;
        return true;
    }
    function addSpace($str){
        return str_replace("%20"," ",$str);
    }
    // Remove this,a,and these type of words from search string
    function parseSearch($str){
        $strArr = explode("%20",$str);
        $len = count($strArr);
        for($i = 0; $i < $len;$i++){
            $unset = true;
            switch ($strArr[$i]) {
                case 'this':
                    break;
                case 'and':
                    break;
                case 'a':
                    break;
                case 'are':
                    break;
                case 'is':
                    break;
                case 'for':
                    break;
                case 'best':
                    break;
                case 'the':
                    break;
                case 'biggest':
                    break;
                case 'smallest':
                    break;
                default:
                    $unset = false;
            }
            if ($unset)
                unset($strArr[$i]);
            else if($i > 0)
                $strArr[$i] .= "%20";

        }
        return $strArr;
    }
}
