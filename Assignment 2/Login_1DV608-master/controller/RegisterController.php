<?php
namespace controller;
class RegisterController{
    private $regModel;
    private $regView;

    public function __construct(\view\RegisterView $registerView, \model\Register $registerModel)
    {
        $this->regModel = $registerModel;
        $this->regView = $registerView;
        $this->bcrypt = new \Bcrypt();
        $this->doRegister();
        $this->regView->setMessage();
    }

    public function doRegister(){
        //if register button is pressed
        if($this->regView->userWantsToRegister()){
            //fetch input from user
            $assignedUsername = $this->regView->getInputUsername();
            $assignedPassword = $this->regView->getInputPassword();
            //if $assignedUsername OR $assignedPassword == false - stop registration!
            if($assignedUsername && $assignedPassword){
                //check if user already exists
                if($this->regModel->checkIfUserExists($assignedUsername)){
                    //if user already exists - set RegisterView variable accordingly and call setMessage
                    $this->regView->userAlreadyExists = true;
                }
                else{
                    //register user
                    $this->regModel->registerUser($assignedUsername, $assignedPassword);
                    //set and return success message to view
                    $this->regView->registrationSuccess = true;
                    //load login-view along with success registration message(already in view as new function?) and new $assignedUsername.
                }
            }
        }
    }
}