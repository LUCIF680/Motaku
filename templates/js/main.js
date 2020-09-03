function screenWidth() {
    let width = window.innerWidth
        || document.documentElement.clientWidth
        || document.body.clientWidth;
    return width;
}
// removing the preloader
function removePreload(){
    document.getElementById("preloader").style.display = "none";
    document.body.style.backgroundColor ="white";
}
if (!String.prototype.startsWith) {
    String.prototype.startsWith = function(searchString, position) {
        position = position || 0;
        return this.indexOf(searchString, position) === position;
    };
}
function remove($array,$element) {
    let index = $array.indexOf($element);
    if (index == -1)
        return $array;
    if (index > -1) {
        $array.splice(index, 1);
        return $array;
    }

}
function indexOfAll($string,$element) {
    let $posList = [];
    while (true){
        let $pos = $string.indexOf($element);
        if ($pos === -1)
            break;
        $posList.push($pos);
        $string = $string.replace($element,"");
    }
    return $posList;
}
// Will be used for @image in blogContent
function addImage($string,$hidden) {
    $images = JSON.parse($hidden[0].value);
    $user_id = $hidden[1].value;
    $i = 0;
    for ($i = 0;$i < 50;$i++){
        if ($string.includes("@image("+$i+")")){
            $string = $string.replace("@image("+$i+")",
            "<img  class='img-fluid' src='blog/"+$user_id+"/images/"+$images[$i-1]+"'>");
        }
    }
    return $string;
}
// Changing @bold to <b>
function changeToBlod($string){
    while (true){
        let $start_pos = $string.indexOf("@bold(");
        if ($start_pos==-1)
            break;
        $start_pos = $start_pos + 6;
        let $last_pos = $string.indexOf(")",$start_pos);
        let $boldString = $string.substring($start_pos,$last_pos);
        $string = $string.replace("@bold("+ $boldString+")","<b>"+$boldString+"</b>")
        document.getElementsByClassName('blogSection')[0].innerHTML = $string;
    }
}
// Changing @header to <h3>
function changeToH3($string){
    while (true){
        let $start_pos = $string.indexOf("@header(");
        if ($start_pos==-1)
            break;
        $start_pos = $start_pos + 8;
        let $last_pos = $string.indexOf(")",$start_pos);
        let $boldString = $string.substring($start_pos,$last_pos);
        $string = $string.replace("@header("+ $boldString+")","<h3>"+$boldString+"</h3>")
        document.getElementsByClassName('blogSection')[0].innerHTML = $string;
    }
}
class Cookie{
    // function to cookie
    static setCookie(name, value, exdays) {
        let d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/masterotaku";
    }

    static getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    static checkCookie(search) {
        let user = Cookie.getCookie(search);
        return (user == "");
    }
}
