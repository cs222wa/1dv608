<?php
    namespace controller;

    class LoginController{

        private $loginView;
        private $loginModel;

        public function _construct(\view\LoginView $loginView, \model\User $loginModel){
            $this->loginView = $loginView;
            $this->loginModel = $loginModel;
        }

        //METHOD RUNS EVERYTHIME THE PAGE IS RELOADED IN ORDER TO DETERMINE WHAT NEEDS TO BE DONE
        public function doLogin(){

      /*      //IF USER WANTS TO LOGIN INTO THE APPLICATION
            if ($this->loginView->userWantsToLogin()){
                //send question to method in view to control if the login button has been clicked (if form has been sent).
                //if button is clicked (not null) - control that information in both Username and Password has been provided.
                //if not null and form filled out correctly -  send the information provided from the view to the model in order to compare it.
                //
                //If the result from the model says all is correct - login user: display login message and send request to view to display logout button.
                //If the result from the model says something is wrong - request the user to enter their information again - provide recently used username in form!
                //
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
             }    */
        }
    }