<?php
namespace model;
class Register{
    private $bcrypt;
    private static $sessionLocation = "newUser";

    public function __construct(){
        $this->bcrypt = new \Bcrypt();
    }

    public function checkIfUserExists($username){
        //check if user exists against folder containing username files
        if(file_exists("data/" .$username . ".txt")){
            return true;
        }
        return false;
    }

    public function registerUser($username, $password){
        //create new text file in data folder with the same name as the user
        $newUserFile = fopen("data/" .$username . ".txt", "w");
        //hash user password
        $input = $this->bcrypt->hash($password);
        //write new file and information to folder
        fwrite($newUserFile, $input);
        fclose($newUserFile);
        $_SESSION[self::$sessionLocation] = $username;
    }

    public function unsetSession(){
        unset($_SESSION[self::$sessionLocation]);
    }

    public function isNewUser(){
        return isset($_SESSION[self::$sessionLocation]);
    }
    public function getNewUser(){
        return $_SESSION[self::$sessionLocation];
    }
}