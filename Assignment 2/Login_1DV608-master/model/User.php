<?php
    namespace model;

    class User{

        private $username;
        private $password;

        public function _construct($username, $password){
            assert(is_string($username) && strlen($username) > 0);
            assert(is_string($password) && strlen($password) > 0);

            $this->username = $username;
            $this->password = $password;
        }

        public function getRequestUserName(){
            return $this->username;
        }
    }

    //Store provided username in session in order to display it in the form.