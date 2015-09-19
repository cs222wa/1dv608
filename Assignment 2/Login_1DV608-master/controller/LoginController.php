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


                $this->loginModel->tryToLogin($assignedUsername, $assignedPassword);

                $this->loginView->response();

               /* //send login information to User in order to control that both Username and Password has been provided.
                //and that they match with the information in the system
                  if($controlUsername = $this->loginModel->getRequestUserName($loginInfo[0])){
                      if($controlPassword = $this->loginModel->getRequestPassword($loginInfo[1])){
                          //If the result from the model says all is correct - login user: display new view with login message and send request to view to render logout button.
                          return true;
                      }
                      //If the result from the model says something is wrong - request the user to enter their information again - provide recently used username in form!
                    return false;
                  }
                //If the result from the model says something is wrong - request the user to enter their information again - provide recently used username in form!
                return false;*/
            }
            elseif($this->loginView->userIsLoggedIn()){
                //send question to view if user is already verified and logged in. (ex has the logout button been rendered?)

                if($this->loginView->userWantsToLogout()){
                    //send question to method in view if the logout button has been clicked
                    //if button is clicked - true - log out user.
                }
            }
            else{
                //If user does not want to log in (aka userWantsToLogin returns false/null - simply display the loginview as usual (empty form)
                return false;
             }
        }
    }