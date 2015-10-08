<?php
namespace controller;
class LoginController{
    private $loginView;
    private $loginModel;
    public function __construct(\view\LoginView $loginView, \model\User $loginModel){
        $this->loginView = $loginView;
        $this->loginModel = $loginModel;
    }
    //METHOD RUNS WHEN THE PAGE IS LOADED IN ORDER TO DETERMINE WHAT NEEDS TO BE DONE
    public function doLogin(){
        //send question to view if user is already verified and logged in.
        if($this->loginModel->isLoggedIn()){
            //If user is logged in, send question to method in view if the logout button has been clicked
            if($this->loginView->userWantsToLogout()){
                $this->loginModel->doLogout();
                    //If user wants to log out send logout message type from view to session in user
                    $this->loginModel->setMessage( $this->loginView->logoutSuccess());
                    //then log out user.
                    $this->loginView->response();
                    //return false to index.php to render correct view
                    return false;
                }
                //return true to index.php if user is logged in
                return true;
        }
        //IF USER WANTS TO LOGIN INTO THE APPLICATION (BY CLICKING THE LOGIN BUTTON)
        elseif ($this->loginView->userWantsToLogin()){
            //check if input is valid
            if($this->loginView->checkInput()){
                //if input is not valid - call method in view to display appropriate response
                $this->loginView->response();
                //return false to index.php to render correct view
                return false;
            }
            //GET THE LOGIN INFORMATION PROVIDED BY THE USER
            $loginInfo = $this->loginView->getInput();
            $assignedUsername = $loginInfo[0];
            $assignedPassword = $loginInfo[1];
            //send login information to Model in order to control that both Username and Password match the information in the system
            $outcome = $this->loginModel->tryToLogin($assignedUsername, $assignedPassword);
            //If the login information passes validation...
            if($outcome){
                //...send login message type from view to session in user
                $this->loginModel->setMessage( $this->loginView->loginSuccess());
                //return true to index.php to render correct view
                return $outcome;
            }
            else{
                //If the login information doesn't pass validation - send login fail message type from view to session in user
                $this->loginModel->setMessage( $this->loginView->loginFail());
                //return false to index.php to render correct view
                return $outcome;
            }
        }
        else{
            //If user does not want to log in - send false to index.php to render an empty form
            return false;
        }
    }
}