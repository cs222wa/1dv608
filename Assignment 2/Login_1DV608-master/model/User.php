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

   /*     public function getRequestUserName($usernameInput)
        {
            //assert that the provided input is a string and is longer than 0 characters
            assert(is_string($usernameInput) && strlen($usernameInput) > 0);
            //Compare the two usernames to see if they match

            if ($usernameInput == $this->username) {
                //save the provided username in a session variable.
                $_SESSION['providedUsername'] = $usernameInput;
                return true;
            }
            return false;
        }

        public function getRequestPassword($passwordInput)
        {
            //assert that the provided input is a string and is longer than 0 characters
            assert(is_string($passwordInput) && strlen($passwordInput) > 0);
            //Compare the two passwords to see if they match
            if ($passwordInput == $this->password) {
                return true;
            }
            return false;
        }*/


        public function tryToLogin($usernameInput, $passwordInput){
            //assert that the provided input is a string and is longer than 0 characters
          //  assert(is_string($usernameInput) && strlen($usernameInput) > 0);
            //assert that the provided input is a string and is longer than 0 characters
          //  assert(is_string($passwordInput) && strlen($passwordInput) > 0);
            //Compare the two usernames to see if they match

            if ($usernameInput == $this->username) {
                //Compare the two passwords to see if they match
                if ($passwordInput == $this->password) {
                    $_SESSION['usernameInput'] = $this->username;
                    $_SESSION['passwordInput'] = $this->password;
                    return true;
                }
                return false;
            }
            return false;
        }
    }

    //Store provided username in session in order to display it in the form.

    //gör metod för $_SESSION['LoggedIn'] = true;