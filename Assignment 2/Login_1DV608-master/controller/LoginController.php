<?php
    namespace controller;

    class LoginController{

        private $loginView;

        public function _construct(\model\User $username, $password){
            $this->username = $username;
            $this->password = $password;
            $this->$loginView = new \view\LoginView($this->username, $this->password);

        }

    }