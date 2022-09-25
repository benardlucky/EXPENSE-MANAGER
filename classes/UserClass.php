<?php
include(dirname(__DIR__).'/config/database.php');
include(dirname(__DIR__).'/validations/authentication.php');

class UserClass
{
    protected $mysql;

    public function __construct() {

    }

    public function login($username, $password) {

        $is_validated = validateUser($username, $password);
        
        if(!$is_validated['status']) {
            return $is_validated;
        }
        return $is_validated;
    }
}
