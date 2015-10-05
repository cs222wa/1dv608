<?php
namespace model;
class Register{
    private $username;
    private $password;
    private $passwordRepeated;
    //create and assert valid user and login information on creation
    public function __construct($username, $password, $passwordRepeated)
    {
        assert(is_string($username) && strlen($username) > 0);
        assert(is_string($password) && strlen($password) > 0);
        assert(is_string($passwordRepeated) && strlen($passwordRepeated) > 0);
        $this->username = $username;
        $this->password = $password;
        $this->passwordRepeated = $passwordRepeated;
        /*
         * take users new registration input as argument (password, repeated password and username)
         *
         *         */
    }

    public function setMessage($message){
        $_SESSION['Message'] = $message;
    }

    public function validateInput($usernameInput, $passwordInput, $passwordRepeatedInput){
        try{
            new User($usernameInput, $passwordInput, $passwordRepeatedInput);
        }
        catch(\Exception $e){
            //if username or password doesn't pass validation - return false.
            return false;
        }
    }

}


/*
    //clear txt-filen and then rewrite everything with the information in array to txt-file?
    public function addUser(){

    }
 */