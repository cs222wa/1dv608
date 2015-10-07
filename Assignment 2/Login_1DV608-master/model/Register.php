<?php
namespace model;
class Register{
    private $username;
    private $password;
    private $passwordRepeated;

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
        $input = password_hash($password, PASSWORD_DEFAULT);
        //write new file and information to folder
        fwrite($newUserFile, $input);
        fclose($newUserFile);
    }
}