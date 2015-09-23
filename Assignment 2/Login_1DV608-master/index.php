<?php
//Starts new session
session_start();

//INCLUDE THE FILES NEEDED...
require_once('controller/LoginController.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/User.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$lc = false;

//CREATE OBJECTS OF THE MODEL
$u = new \model\User("Admin", "pw");

//CREATE OBJECTS OF THE VIEWS
$v = new \view\LoginView();
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView();

//CREATE OBJECT OF THE CONTROLLER - SEND OBJECTS OF LoginVIEW AND User AS PARAMETERS
$lc = new \controller\LoginController($v, $u);

var_dump($_SESSION['Message']);
var_dump($_SESSION['loggedIn']);
//CALL CONTROLLER METHOD doLogin IN ORDER TO DETERMINE WHAT NEEDS TO BE DONE WITH THE APPLICATION
$isLoggedIn = $lc->doLogin();

//RENDER THE LAYOUTVIEW METHOD render IN ORDER TO DISPLAY LOGIN PAGE
$lv->render($isLoggedIn, $v, $dtv);
