<?php
namespace controller;
class RegisterController{
    private $regModel;
    private $regView;
    public function __construct(\view\RegisterView $registerView, \model\Register $registerModel)
    {

        $this->regModel = $registerModel;
        $this->regView = $registerView;
    }
}