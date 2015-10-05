<?php
namespace controller;
class RegisterController{
    private $regModel;
    private $regView;
    public function __construct(\view\RegisterView $registerView, \model\Register $registerModel)
    {
        $this->regModel = $registerModel;
        $this->regView = $registerView;
        $this->doRegister();
    }

    public function doRegister(){
        //if register button is pressed
        if($this->regView->userWantsToRegister()){
            //fetch input from user
            $userInput = $this->regView->getUserInput();
            $assignedUsername = $userInput[0];
            $assignedPassword = $userInput[1];
            $assignedPasswordRepeat = $userInput[2];
            //if the input passes validation
            $outcome = $this->regModel->validateInput($userInput[0],$userInput[1], $userInput[2]);
            if($outcome){
                //register user
                $this->regModel->registerUser($userInput);
                //set and return successmessage to view
                $this->regModel->setMessage( $this->regView->registerSuccess()); //<--needed???
                //render view
                $this->regView->response();
            }
            else{
                //If the login information doesn't pass validation - send login fail message type from view to session in user
                $this->regModel->setMessage( $this->regView->registrationFail());
                //render view
                $this->regView->response();
            }
        }


    }
}