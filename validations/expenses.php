<?php

function validateExpenses($merchant, $amount, $date, $comment) {
    if(empty($merchant) || empty($amount) || empty($date) || empty($comment)) {
        return [
            'status' => false,
            'message' => 'All fields are required'
        ];
    }
    return [
        'status' => true,
        'message' => 'Expense validated'
    ];
}