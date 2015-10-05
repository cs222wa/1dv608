<?php
//Starts new session
session_start();

//INCLUDE THE FILES NEEDED...
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');
require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/User.php');
require_once('model/Register.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$lc = false;

//CREATE OBJECTS OF THE MODEL
$u = new \model\User("Admin", "pw");
$r = new \model\Register("test", "test", "test");

//CREATE OBJECTS OF THE VIEWS
$v = new \view\LoginView();
$dtv = new \view\DateTimeView();
$rv = new \view\RegisterView();
$lv = new \view\LayoutView();

//CREATE OBJECT OF THE CONTROLLER - SEND OBJECTS OF THE CORRESPONDING VIEWS AND MODELS AS PARAMETERS
$lc = new \controller\LoginController($v, $u);
$rc = new \controller\RegisterController($rv, $r);

//CALL CONTROLLER METHOD doLogin IN ORDER TO DETERMINE IF USER IS LOGGED IN OR NOT
$isLoggedIn = $lc->doLogin();

//PICK WHICH VIEW TO DISPLAY
$lv->setLayout($isLoggedIn, $v, $dtv, $rv);

