class Model{
   static checkEmail($email){
       if (($email.includes(" "))||($email.includes(";")))
           return false; // show error
       if (($email.includes("@"))&&($email.includes(".")))
            return true;
       return false;// show error
    }
    onSubmit() {
       document.getElementsByTagName('button')[0].onclick = function () {
           let $password = document.getElementsByTagName('input')[2].value;
            let $email = document.getElementsByTagName('input')[1].value;
            if (($password=="")||($email=="")){
                let $view = new View();
                $view.view(1);
                return false;
            }
            else if($password.length<8){
                let $view = new View();
                $view.view(2);
                return false;
            }
            else if (!Model.checkEmail($email)){
                let $view = new View();
                $view.view(3);
                return false;
            }
            else
                return true;
        }
    }
}
class View{
    view($error){
        switch ($error) {
            case 1:
                document.getElementsByClassName('error')[0].textContent = "Password and email field cannot be empty";
                break;
            case 2:
                document.getElementsByClassName('error')[0].textContent= "Password must be greater than 8 characters";
                break;
            case 3:
                document.getElementsByClassName('error')[0].textContent = "Wrong Email Format";
                break;
        }
    }
}
window.onload = function () {
    let $login= new Model();
    $login.onSubmit();
};

