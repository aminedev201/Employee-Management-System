<?php 
require_once '../app/core/init.php';

$url = isset($_GET['url']) && !empty(Validator::skip($_GET['url'])) ? Validator::skip($_GET['url']) : 'Admin';
App::loadController($url);
