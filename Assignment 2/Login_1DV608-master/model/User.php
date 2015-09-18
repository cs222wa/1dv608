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

        public function getRequestUserName($usernameInput)
        {
            //assert that the provided input is a string and is longer than 0 characters
            assert(is_string($usernameInput) && strlen($usernameInput) > 0);

            //save the provided username in a session variable.
            $_SESSION['providedUsername'] = $usernameInput;
            //Compare the two usernames to see if they match

            if ($usernameInput = $this->username) {
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
        }
    }

    //Store provided username in session in order to display it in the form.