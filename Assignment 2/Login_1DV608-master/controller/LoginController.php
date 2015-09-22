<?php
    namespace controller;

    class LoginController{

        private $loginView;
        private $loginModel;

        public function __construct(\view\LoginView $loginView, \model\User $loginModel){
            $this->loginView = $loginView;
            $this->loginModel = $loginModel;
        }

        //METHOD RUNS EVERYTHIME THE PAGE IS RELOADED IN ORDER TO DETERMINE WHAT NEEDS TO BE DONE
        public function doLogin(){

           //IF USER WANTS TO LOGIN INTO THE APPLICATION (BY CLICKING THE LOGIN BUTTON)
            if ($this->loginView->userWantsToLogin()){
                //GET THE LOGIN INFORMATION PROVIDED BY THE USER
                $loginInfo = $this->loginView->getInput();
                $assignedUsername = $loginInfo[0];
                $assignedPassword = $loginInfo[1];
                //send login information to User in order to control that both Username and Password has been provided.
                //and that they match with the information in the system
                $outcome = $this->loginModel->tryToLogin($assignedUsername, $assignedPassword);
                //Call response method in the view which checks the outcome saved in a $_SESSION variable.
                $this->loginView->response();
                return $outcome;
            }
            elseif($this->loginView->userIsLoggedIn()){
                //send question to view if user is already verified and logged in. (ex has the logout button been rendered?)

                if($this->loginView->userWantsToLogout()){
                    //send question to method in view if the logout button has been clicked
                    if ($this->loginView->userWantsToLogout()){
                        //if button is clicked - true - log out user.
                        $this->loginView->response();
                        return false;
                    }
                    return false;

                    /*
                     * Session for welcome message-
                     * Save message in session variable
                     * do a page reload (NOT page redirect, but another one)
                     * Reload the session variable
                     * kill the session.
                     *
                     */
                }
            }
            else{
                //If user does not want to log in (aka userWantsToLogin returns false/null - simply display the loginview as usual (empty form)
                return false;
             }
        }
    }