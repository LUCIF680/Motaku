<?php
require_once 'Controller.php';
$controller = new Controller();
$requestGET = $_GET;
if (!empty($_POST))
    $requestPOST = $_POST;
else
    $requestPOST = "";
switch ($requestGET['path']){
    case 'search':
    $controller->search($requestGET);
        break;
    case 'showblog':
        $controller->showBlog($requestGET);
        break;
    case 'get_next_prev':
        $controller->getNextPrev($requestGET);
        break;
    case '403.shtml':
        $controller->home();
        break;    
    case 'home':
        $controller->home();
        break;
    case 'fetchuser':
        $controller->fetchUser();
        break;
    case 'login':
        $controller->login();
        break;
    case 'checklogin':
        $controller->checkLoginInfo($requestGET,$requestPOST);
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'addblog':
        $controller->addBlog($requestGET,$requestPOST);
        break;
    case 'filepondUpload':
        $controller->filepondUpload();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'signup':
        $controller->signup();
        break;
    case 'verifyemail':
        $controller->verifyEmailPage($requestGET,$requestPOST);
        break;
    case 'registrationdone':
        $controller->registration($requestGET,$requestPOST);
        break;
    case 'recovery':
        $controller->recovery();
        break;
    case 'changepassword':
        $controller->changePassword($requestGET,$requestPOST);
        break;
    case 'changeyourpassword':
        $controller->changePasswordlogic($requestGET,$requestPOST);
        break;
    case 'joinus':
        $controller->joinUs();
        break;
    case 'test':
        $controller->test();
        break;
    case 'session':
        $controller->session();
        break;    
    default:
        $controller->notFoundError();
}