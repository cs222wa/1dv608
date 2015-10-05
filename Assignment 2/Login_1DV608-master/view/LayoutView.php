<?php
namespace view;


use model\Register;

class LayoutView {
  
  public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $rv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
            <a href="?register">Register a new user</a>

          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $v->response() . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }

  public function setLayout($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $rv){

      if($this->checkURL()){
        //create a new RegisterController
        //$rc = new \controller\RegisterController($rv, $r);
        //display RegisterView if checkURL returns true
      }
    else{
      //else, display ordinary loginview
      $this->render($isLoggedIn, $v, $dtv, $rv);
    }
  }

  private function checkURL(){
    //if url contains "register" - return true, if not return false
    if(strpos("$_SERVER[REQUEST_URI]", "?register")){
      return true;
    }
    else return false;
  }



}
