<?php
    namespace model;

    class User
    {
        private $username;
        private $password;

        //create and assert valid user and login information on creation
        public function __construct($username, $password)
        {
            assert(is_string($username) && strlen($username) > 0);
            assert(is_string($password) && strlen($password) > 0);
            $this->username = $username;
            $this->password = $password;
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
            //Compare the two usernames to see if they match
            if ($usernameInput == $this->username) {
                //Compare the two passwords to see if they match
                if ($passwordInput == $this->password) {
                    //If they are both correct, create a loggedIn sessionvariable.
                    $_SESSION['loggedIn'] = $this->username;
                    return true;
                }
                //if password fails, no session variable is created and the method returns false.
                return false;
            }
            //if username fails, no session variable is created and the method returns false.
            return false;
        }
        //sets message type from the controller to a session variable
        public function setMessage($message){
            $_SESSION['Message'] = $message;
        }
    }