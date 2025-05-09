<?php
require_once 'db.php';

function insertUser($userName , $email , $password) {
    global $pdo;   
    $stmt = $pdo->prepare("INSERT INTO users (username, email, userpassword) VALUES (?, ?, ?)");
    $stmt->execute([$userName,$email,$password]);
}

function doesUserNameExist($userName) {
    global $pdo;   
    $stmt = $pdo->prepare("SELECT count(*) FROM users WHERE username = ?");
    $stmt->execute([$userName]);
    $exist = $stmt->fetch(PDO::FETCH_ASSOC)['count(*)'];
    if ($exist == 0) {
        return false;
    }
    else{
        return true;
    }
}


function doesEmailExist($email) {
    global $pdo;   
    $stmt = $pdo->prepare("SELECT count(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $exist = $stmt->fetch(PDO::FETCH_ASSOC)['count(*)'];
    if ($exist == 0) {
        return false;
    }
    else{
        return true;
    }
}

?>