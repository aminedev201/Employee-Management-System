<?php
session_start();

require '../app/includes/libraries/vendor/autoload.php';
require_once 'Glb.php';
require_once 'Glb.php';
require_once 'Validator.php';
require_once 'Controller.php';
require_once 'config.php';
require_once 'Database.php';
require_once 'Model.php';
spl_autoload_register(function($class){
    
    require '../app/models/'.$class.'.php';
    
});

require_once 'App.php';

