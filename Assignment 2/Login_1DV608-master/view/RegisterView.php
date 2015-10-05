<?php
namespace view;
class RegisterView{
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordrepeat = 'RegisterView::PasswordRepeat';
    private static $messageId = 'RegisterView::Message';
    private static $register = 'RegisterView::Register';
    private $message;


    public function renderLink(){
        return '<a href="?">Back to login</a>';
    }

    public function response() {
        $message = $this->message;
        //render HTML views and message dependant on users registration success
        return $this->renderRegisterForm($message);
    }
    //returns message to response()
    public function getMessage($messagetype){
        return $this->message = $messagetype;
    }

    public function usernameTooShort(){
        return $this->getMessage('Username has too few characters, at least 3 characters.');
    }

    public function passwordTooShort(){
        return $this->getMessage('Password has too few characters, at least 6 characters.');
    }

    public function registerSuccess(){
        return $this->getMessage('User has been registered.');
    }
    public function registrationFail(){
        return $this->getMessage('User has not been registered.');
    }

    private function renderRegisterForm($message){
        return '
			<form action="?register" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Register a new user - Write username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" size="20" id="' . self::$name . '" name="' . self::$name . '" value=""/>
					<label for="' . self::$password . '">Password :</label>
					<input type="password" size="20" id="' . self::$password . '" name="' . self::$password . '" value=""/>
					<label for="' . self::$passwordrepeat . '">Repeat Password :</label>
					<input type="password" size="20" id="' . self::$passwordrepeat . '" name="' . self::$passwordrepeat . '" value=""/>

					<input type="submit" name="' . self::$register . '" value="Register"/>
				</fieldset>
			</form>
		';
    }


    public function userWantsToRegister(){
        if (isset($_POST[self::$register])){
            return true;
        }
        //If logout button is not clicked return false.
        return false;
    }

    public function getUserInput(){
        if(isset($_POST[self::$name]) && isset($_POST[self::$password]) && isset($_POST[self::$passwordrepeat])){
            $loginUser = array();
            $loginUser[] = $_POST[self::$name];
            $loginUser[] = $_POST[self::$password];
            $loginUser[] = $_POST[self::$passwordrepeat];
            return $loginUser;
        }
        //if the form is not correctly filled out - return false.
        return false;
    }
}
