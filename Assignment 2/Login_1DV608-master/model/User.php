<?php
    namespace model;

    class User
    {

        private $username;
        private $password;

        public function __construct($username, $password)
        {
            assert(is_string($username) && strlen($username) > 0);
            assert(is_string($password) && strlen($password) > 0);

            $this->username = $username;
            $this->password = $password;
        }

        //assert that the provided input is a string and is longer than 0 characters
        private function assertInput($input){
           return assert(is_string($input) && strlen($input) > 0);
        }

        public function tryToLogin($usernameInput, $passwordInput){
            //send input to be asserted
            if(!$this->assertInput($usernameInput)){
                //If username is not a string or less than 0 characters - create session variable and throw an exception
                $_SESSION["noUsername"] = true;
               // throw new \Exception;
            }
            //send input to be asserted
            if(!$this->assertInput($passwordInput)){
                //If password is not a string or less than 0 characters - create session variable and throw an exception
                $_SESSION["noPassword"] = true;
               // throw new \Exception;
            }
            //Compare the two usernames to see if they match
            if ($usernameInput == $this->username) {
                //Compare the two passwords to see if they match
                if ($passwordInput == $this->password) {
                    //If they are both correct, create sessionvariable with the username.
                    $_SESSION['loggedIn'] = $this->username;
                   // $_SESSION['passwordInput'] = $this->password;
                    return true;
                }
                //if password fails, a session variable is created and the method returns false.
                $_SESSION['loginFail'] = true;
                return false;
            }
            //if username fails, a session variable is created and the method returns false.
            $_SESSION['loginFail'] = true;
            return false;
        }
    }