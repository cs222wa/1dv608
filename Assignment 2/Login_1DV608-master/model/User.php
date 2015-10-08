<?php
namespace model;
class User
{
    private $bcrypt;
    private static $sessionLocation = "modelUserIsLoggedIn";
    //create and assert valid user and login information on creation
    public function __construct()
    {
        $this->bcrypt = new \Bcrypt();
    }

    //login user
    public function tryToLogin($usernameInput, $passwordInput){
        //send username and password to constructor to validate if they are of type string and more than 0 characters long
        try{
            new User($usernameInput, $passwordInput);
        }
        catch(\Exception $e){
            //if username or password doesn't pass validation - return false.
            return false;
        }
        //Compare the username to existing file name to see if they match
        if(file_exists("data/" . $usernameInput . ".txt")){
            //if they match - open file
            $file = fopen("data/" . $usernameInput . ".txt", "r");
            //if the de-hashed password and user input matches...
            $content = fgets($file);
            if($this->bcrypt->verify($passwordInput, $content)){
                //close the file
                fclose($file);
                //set logged in session and return true
                $_SESSION[self::$sessionLocation] = $usernameInput;
                return true;
            }
            else{
                //close the file
                fclose($file);
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function isLoggedIn(){
        return isset($_SESSION[self::$sessionLocation]);
    }

    public function doLogout(){
        unset($_SESSION[self::$sessionLocation]);
    }


    //sets message type from the controller to a session variable
    public function setMessage($message){
        $_SESSION['Message'] = $message;
    }
}