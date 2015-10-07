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

    public function checkIfUserExists($username){
        //check if user exists against harcoded username value
        if($username == "Admin") {
            return true;
        }
        return false;
    }

    public function registerUser($username, $password){

        //skriv in användarnamn & lösenord i text-fil.

    }
}