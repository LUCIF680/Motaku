document.getElementsByTagName('form')[0].onsubmit = function () {
    let $passwords = document.getElementsByClassName('password');
    switch ($passwords.length) {
        case 2:
            console.log('ye');
            if (($passwords[0].value == "") || ($passwords[1].value == "")) {
                document.getElementById('error').innerHTML = "Password and email field cannot be empty";
            } else if ($passwords[0].value.length < 8 || $passwords[1].value.length < 8) {
                document.getElementById('error').innerHTML = "Password must be greater than 8 characters";
            }
            break;
        case 3:
            console.log('hello');
            if (($passwords[2].value == "") || ($passwords[0].value == "") || ($passwords[1].value == "")) {
                document.getElementById('error').innerHTML = "Password and email field cannot be empty";
            } else if ($passwords[0].value.length < 8 || $passwords[2].value.length < 8 || $passwords[1].value.length < 8) {
                document.getElementById('error').innerHTML = "Password must be greater than 8 characters";
            }
            break;
        default:
            break;
    }
};