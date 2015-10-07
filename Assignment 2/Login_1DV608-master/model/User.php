<?php
namespace model;
class User
{
    private $username;
    private $password;
    private $bcrypt;
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
            if($this->bcrypt->verify($passwordInput, fgets($file))){
                //close the file
                fclose($file);
                //set logged in session and return true
                $_SESSION['loggedIn'] = $this->username;
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


    //sets message type from the controller to a session variable
    public function setMessage($message){
        $_SESSION['Message'] = $message;
    }
}