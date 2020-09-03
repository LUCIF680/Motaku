<?php
class File {
    private $imageName=array();
    private $thumbnail;
    private $videoName=null;
    function startsWith($haystack, $needle){
            $length = strlen($needle);
            return (substr($haystack, 0, $length) === $needle);
    }
    function videoConstrains($video){
            if ($video['size'] == null)
            return true;
            if ($this->startsWith($video['type'],'video') === false)
            return false;
            if($video['size'] > 524288000)
            return false;
            if ($video['error'] > 0)
            return false;
            return true;
    }
    function imageConstrains($image){
            if ($image['size'] == null)
            return true;
            if ($this->startsWith($image['type'],'image') == false)
            return false;
            if($image['size'] > 24288000)
            return false;
            if ($image['error'] > 0)
            return false;
            return true;
    }
    function uploadFile($file,$type){
            $i = 1;
            for (;file_exists(sprintf("blog/%d/temp/%d",$_SESSION["user"]["id"],$i)) == True;$i++);
            move_uploaded_file($file["tmp_name"],sprintf("blog/%d/temp/%d",$_SESSION["user"]["id"],$i));
            if ($type === "images")
                $this->imageName = $i;
            else if ($type === "thumbnail")
                $this->thumbnail= $i;
            else
                $this->videoName= $i;
    }
    function moveImages(){
        if (isset($_SESSION['image'])) {
            foreach ($_SESSION['image'] as $images) {
                $i = 1;
                for (;file_exists(sprintf("blog/%d/images/%d",$_SESSION["user"]["id"],$i)) == True;$i++);
                rename(
                    sprintf("blog/%d/temp/%d", $_SESSION["user"]["id"], $images),
                    sprintf("blog/%d/images/%d", $_SESSION["user"]["id"], $i));
                array_push($this->imageName,$i);
            }
        }
        if (isset($_SESSION['thumbnail'])) {
            $i = 1;
            for (;file_exists(sprintf("blog/%d/images/%d",$_SESSION["user"]["id"],$i)) == True;$i++);
            rename(
                    sprintf("blog/%d/temp/%d", $_SESSION["user"]["id"], $_SESSION['thumbnail']),
                    sprintf("blog/%d/images/%d", $_SESSION["user"]["id"], $i));
            $this->thumbnail = $i;
        }
    }
    function getThumbnailName(){
        return $this->thumbnail;
    }
    function getImageName(){
            return $this->imageName;
    }
    function getVideoName(){
            return $this->videoName;
    }
}