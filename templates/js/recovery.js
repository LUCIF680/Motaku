/*Model
* =====*/
function checkEmail($email){
    if (($email.includes(" "))||($email.includes(";")))
        return false; // show error
    if (($email.includes("@"))&&($email.includes(".")))
        return true;
    return false;// show error
}
/*
* Controller
*===========*/
document.querySelector('button').onclick = function(){
    let $email = document.querySelector('input').value;
    if (!checkEmail($email)){
        document.getElementsByClassName('error')[0].textContent = "Wrong Email Format";
        return false;
    }
};

