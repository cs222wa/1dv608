<?php
namespace view;
class RegisterView{
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $repeatpassword = 'RegisterView::RepeatPassword';
    private static $messageId = 'RegisterView::Message';
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
					<label for="' . self::$repeatpassword . '">Repeat Password :</label>
					<input type="password" size="20" id="' . self::$repeatpassword . '" name="' . self::$repeatpassword . '" value=""/>

					<input type="submit" name="doRegister" value="Register" />
				</fieldset>
			</form>
		';
    }
}
