<?php 
class Validator {

    public static function skip($input){

        return strip_tags(htmlspecialchars(trim($input)));
    }

    public static function validateEmail($email) {
    
        return preg_match("/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email) == 1;
    }

    public static function validatePhone($phone) {
    
        return preg_match('/^\+?\d{1,4}[\s\-]?\(?\d{1,3}\)?[\s\-]?\d{3}[\s\-]?\d{4}$/', $phone) == 1;
    }
    
    public static function validateCIN($CIN) {

        return preg_match('/^[A-Za-z0-9]+$/', $CIN) == 1;
    }

}