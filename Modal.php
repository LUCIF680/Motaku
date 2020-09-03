<?php
interface Constants{
    const IMAGE = "images";
    const VIDEO = "videos";
    const THUMBNAIL = "thumbnail";
}
class Modal extends SQNile{
    use Itari;
    function createUserTable($user_id){
        $table_name = 100;
        while(true) {
            if ($table_name>=$user_id)
                break;
            else
                $table_name = $table_name+100;
        }
        try{ //creating table
            $sql = "CREATE TABLE `".$table_name."` ( `".$user_id."` VARCHAR(11) NULL )";
            $this->conn->exec($sql);
            return $table_name;
        }
        catch(PDOException $e){
            $user_minus_one = $user_id-1;
            $table_exists = $e->getMessage();
            $string = "SQLSTATE[42S01]: Base table or view already exists: 1050 Table '".$table_name."' already exists";
            // if table exists than add column to it
            if ($table_exists == $string) {
                try {
                    $this->query('ALTER TABLE `$table_name` ADD `$user_id` VARCHAR(11) NULL after ".$user_minus_one."');
                }
                catch(PDOException $e) {echo $e->getMessage();}
            }else
                echo $e->getMessage();
        }
    }
    function setCookieName($name){
        if (strlen($name) > 10) {
            $show_name = substr($name, 0, 9); // if name length greater than 10 take 9 chars to show
            setcookie("name", $show_name, time() + (86400 * 30));
        } else {
            setcookie("name", $name, time() + (86400 * 30));
        }
    }
    function setReference(){
        $ref = array();
        $ref[0] = $this->randomString(63);   // the real one
        $ref[1]= $this->randomString(63);//fake one
        $ref[2] = $this->randomString(63); // fake one
        $ref[3]=  $this->randomString(11); // ref id
        return $ref;
    }
    function destroySessionWithMsg(){
        session_start();
        $msg = $this->getMsg();
        if (isset($_SESSION['user']['login'])) {
            $this->redirect("home");
        }else
            session_destroy();
        session_commit();
        return $msg;
    }
    function loadFormTemplate($template,$var){
        $action = $var['action_php'] . "?" . $_SESSION['name']['encode'] . "=" . $_SESSION['encodeValue'];
        $msg = $var["msg"];
        require_once 'templates/'.$template.".php";
    }
    function getHomeBlog(){
        $this->setDatabaseInfo('masterotaku');
        $blogs = $this->fetchAll("SELECT * FROM files ORDER BY ID DESC LIMIT 24");
        return $blogs;
    }
    function getBlogById($id){
        $this->setDatabaseInfo('masterotaku');
        $blog = $this->fetch("SELECT * FROM files WHERE id = ?", [$id]);
        if (empty($blog))
            Throw new Exception("Page does not Exists"); // if get request is fake
        $this->setDatabaseInfo('itarimusic');
        return $blog;
    }
}