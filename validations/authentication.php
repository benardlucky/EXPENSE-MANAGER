<?php

function validateUser($username, $password) {
    if(empty($username)) {
        return [
            'status' => false,
            'message' => 'Username cannot be empty'
        ];
    }
    else if(empty($password)) {
        return [
            'status' => false,
            'message' => 'PAssword cannot be empty'
        ];
    }

    else if($username != 'demo' || $password != 'demo') {
        return [
            'status' => false,
            'message' => 'Invalid credentials'
        ];
    }
    else {
        return [
            'status' => true,
            'message' => 'Credentials validated'
        ];
    }

}