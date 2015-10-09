<?php
namespace view;
class RegisterView{
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $messageId = 'RegisterView::Message';
    private static $register = 'RegisterView::Register';
    private $message = "";
    public $userAlreadyExists = false;
    public $userNameTooShort= false;
    public $passwordTooShort = false;
    public $passwordsDoNotMatch = false;
    public $usernameInvalidChar = false;
    public $registrationSuccess = false;


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
        if($this->userAlreadyExists){
            $this->message .= 'User exists, pick another username.';
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

        if("" == $this->message){
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
					<input type="text" size="20" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getUserName() . '" />
					<label for="' . self::$password . '">Password :</label>
					<input type="password" size="20" id="' . self::$password . '" name="' . self::$password . '" value=""/>
					<label for="' . self::$passwordRepeat . '">Repeat Password :</label>
					<input type="password" size="20" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" value=""/>

					<input type="submit" name="' . self::$register . '" value="Register"/>
				</fieldset>
			</form>
		';
    }

    private function getUserName() {
        //control if the user have entered anything in the username field
        if(isset($_POST[self::$name])){
            return strip_tags($_POST[self::$name]);
        }
        //if username field in the form is empty on submition - display empty form.
        return "";
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
            //check for invalid characters - return true if not found, false if found
           if(!preg_match('/[^A-Za-z0-9.#\\-$]/', $username)){
               //check that username contains more than 3 characters
               if(strlen($username) > 3 && strlen($username) > 0){
                   //return username to controller
                   return $username;
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
        if(!empty($_POST[self::$password]) && !empty($_POST[self::$passwordRepeat])){
            $password = $_POST[self::$password];
            $passwordRepeat = $_POST[self::$passwordRepeat];
            //check that both are longer than 6 characters
            if(strlen($password) > 6 && strlen($password) > 0  && strlen($passwordRepeat) > 6 && strlen($passwordRepeat) > 0){
                //if the passwords match
                if($password==$passwordRepeat){
                    //return password to controller
                    return $_POST[self::$password];
                }
                else{
                    $this->passwordsDoNotMatch = true;
                    return false;
                }
            }
            else{
                $this->passwordTooShort = true;
                return false;
            }
        }
        else{
            $this->passwordTooShort = true;
            return false;
        }
    }
}
