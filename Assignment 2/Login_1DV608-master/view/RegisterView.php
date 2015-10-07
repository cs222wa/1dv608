<?php
namespace view;
class RegisterView{
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $messageId = 'RegisterView::Message';
    private static $register = 'RegisterView::Register';
    private $message = "";
    public $userAlreadyExists;
    public $userNameTooShort;
    public $passwordTooShort;
    public $passwordsDoNotMatch;
    public $usernameInvalidChar;
    public $registrationSuccess;


    public function renderLink(){
        return '<a href="?">Back to login</a>';
    }

    public function response() {
        $message = $this->message;
        //render HTML views and message dependant on users registration success
        return $this->renderRegisterForm($message);
    }

   //sets message
    public function setMessage() {
        $message = "";
        if($this->userAlreadyExists){
            $this->message .= 'User already exists.';
        }
        if($this->userNameTooShort){
            $this->message .= 'Username has too few characters, at least 3 characters.';
        }
        if($this->usernameInvalidChar){
            $this->message .= 'Username contains invalid characters.';
        }
        if($this->passwordTooShort){
            $this->message .= 'Password has too few characters, at least 6 characters.';
        }
        if($this->passwordsDoNotMatch){
            $this->message .= 'Passwords do not match.';
        }
        if($this->registrationSuccess){
            $this->message = 'User has been registered.';
        }
        if($this->message = ""){
            return true;
        }
        return false;
    }

    //renders registration form with correct message.
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
					<label for="' . self::$passwordRepeat . '">Repeat Password :</label>
					<input type="password" size="20" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" value=""/>

					<input type="submit" name="' . self::$register . '" value="Register"/>
				</fieldset>
			</form>
		';
    }

    //checks if user has clicked registerbutton
    public function userWantsToRegister(){
        if (isset($_POST[self::$register])){
            return true;
        }
        //If register button is not clicked return false.
        return false;
    }

    public function getInputUsername(){
        //if a username has been posted
        if(isset($_POST[self::$name])){
            $username = $_POST[self::$name];
            //assert that the input is a string and that its longer than 0 characters
            assert(is_string($username) && strlen($username) > 0);
            //check for invalid characters - return true if not found, false if found
           if(!preg_match('/[^A-Za-z0-9.#\\-$]/', $username)){
               //check that username contains more than 3 characters
               if($username > 3){
                   //return username to controller
                   return $_POST[self::$name];
               }
               $this->userNameTooShort = true;
               return false;
            }
            $this->usernameInvalidChar = true;
        }
        $this->userNameTooShort = true;
        return false;
    }


    public function getInputPassword(){
        //if two sets of passwords have been posted
        if(isset($_POST[self::$password]) && isset($_POST[self::$passwordRepeat])){
            $password = $_POST[self::$password];
            $passwordRepeat = $_POST[self::$passwordRepeat];
            //assert that they both are strings longer than 0 characters
            assert(is_string($password) && strlen($password) > 0);
            assert(is_string($passwordRepeat) && strlen($passwordRepeat) > 0);
            //check that both are longer than 6 characters
            if($password > 6 && $passwordRepeat > 6){
                //if the passwords match
                if($password==$passwordRepeat){
                    //return password to controller
                    return $_POST[self::$password];
                }
                $this->passwordsDoNotMatch = true;
                return false;
            }
            $this->passwordTooShort = true;
            return false;
        }
        $this->passwordTooShort = true;
        return false;
    }
}
