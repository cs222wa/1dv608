<?php
namespace view;

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private $message;

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = $this->message;
		//render different HTML views and messages dependant on users login success
		if(isset($_SESSION['loggedIn'])){ //ska ligga i user
			//user passed login
			$response = $this->generateLogoutButtonHTML($message);
		}
		else{
			//user failed login
			$response = $this->generateLoginFormHTML($message);
		}
		return $response;
	}

	//Displays the message Welcome on login
	public function loginSuccess(){
		return $this->getMessage('Welcome');
	}

	public function loginFail(){
		return $this->getMessage('Wrong name or password');
	}

	//Displays the message Bye bye on logout
	public function logoutSuccess(){
		return $this->getMessage('Bye bye');
	}

	//returns message to response()
	public function getMessage($messagetype){
		return $this->message = $messagetype;
	}

	//Checks if user filled out the login form correctly
	public function checkInput(){
		if(empty($_POST[self::$name])){
			return $this->getMessage("Username is missing");
		}
		elseif(empty($_POST[self::$password])){
			return $this->getMessage("Password is missing");
		}
		else{
			//if neither password not username is provided - return false.
			return false;
		}
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->getRequestUserName() . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {
		//control if the user have entered anything in the username field
		if(isset($_POST[self::$name])){
			return $_POST[self::$name];
		}
		//if username field in the form is empty on submition - display empty form.
		return "";
	}

	//Finds out if user have clicked the login-button.
	public function userWantsToLogin(){
		if (isset($_POST[self::$login])){
			return true;
		}
		//If logout button is not clicked return false.
		return false;
	}

	//returns the input from the user
	public function getInput(){
		//If the form is filled out correctly - Return the information provided in the username and password fields
		if(isset($_POST[self::$name]) && isset($_POST[self::$password])){

			$loginUser = array();
			$loginUser[] = $_POST[self::$name];
			$loginUser[] = $_POST[self::$password];
			return $loginUser;
		}
		//if the form is not correctly filled out - return false.
		return false;
	}

	//find out if the user is already logged in.
	public function userIsLoggedIn(){
		if(isset($_SESSION['loggedIn'])){
			return true;
		}
		//if user is not logged in return false.
		return false;
	}

	//find out if an attempt to log out has been made (if user have clicked the logout button).
	public function userWantsToLogout(){
		if (isset($_POST[self::$logout])){
			//if user klicked the button - unset the session
			unset($_SESSION['loggedIn']);
			return true;
		}
		//If login button is not clicked return false.
		return false;
	}
}
