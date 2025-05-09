<?php
require_once 'db.php';


function isLoginRightEmail($email , $password){
    global $pdo;   
    $stmt = $pdo->prepare("SELECT user_status FROM users WHERE email = ? and  userpassword = ?");
    $stmt->execute([$email,hash('sha256', $password)]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($status === false) {
        return "";
    }
    else {
        return $row['user_status'];
    }
}


function isLoginRightName($userName , $password){
    global $pdo;   
    $stmt = $pdo->prepare("SELECT user_status FROM users WHERE username = ? and  userpassword = ?");
    $stmt->execute([$userName,hash('sha256', $password)]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row===false) {
        return "";
    }
    else {
        return $row['user_status'];
    }
}

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