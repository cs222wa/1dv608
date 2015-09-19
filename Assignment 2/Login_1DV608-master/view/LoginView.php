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

	

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {

		if(isset($_SESSION['usernameInput'])){
			$message = 'You are already logged in.';

			$response = $this->generateLogoutButtonHTML($message);
			return $response;
		}
		else{
			$message = 'You are not logged in.';

			$response = $this->generateLoginFormHTML($message);
			return $response;
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
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $_POST[self::$name] . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	private function getRequestUserName() {

		// Skapa flera liknande get-funktioner som denna för att ta reda på vad användaren gjort/skrivit.
		//är till för att läsa från post-variablerna
		//Det är controllern som anropar och frågar efter input på username.

		//get request password/login/logout etc (se överst i dokumentet som har med formuläret att göra.)

		//RETURN REQUEST VARIABLE: USERNAME
	}

	public function userWantsToLogin(){
		//Find out if user have clicked the login-button = a login attempt has been made.
		if (isset($_POST[self::$login])){
			return true;
		}
		//If login button is not clicked return false.
		return false;

	}

	public function getInput(){
		//If button is clicked - return the information provided in the username and password fields
		if(isset($_POST[self::$name]) && isset($_POST[self::$password])){

			$loginUser = array();
			$loginUser[] = $_POST[self::$name];
			$loginUser[] = $_POST[self::$password];
			return $loginUser;
		}
	}

	public function userIsLoggedIn(){
		//find out if the user is already logger in.
	}

	public function userWantsToLogout(){
		//find out if an attempt to log out has been made.
	}
}