<?php
 
session_start();

require_once 'db.php';


function changePassword($id,$password) {
    global $pdo;   
    $stmt = $pdo->prepare("update users set userpassword= ? where id = ?");
    $stmt->execute([hash('sha256', $password),$id]);
    $stmt->execute(['user',$id]);
}

function verifyUser($id) {
    global $pdo;   
    $stmt = $pdo->prepare("update from token set user_status = ? where id = ?");
    $stmt->execute(['user',$id]);
}

function tokenExists($token) {
    global $pdo;   
    $stmt = $pdo->prepare("Select user_id from token where token_value = ?");
    $stmt->execute([$token]);
    $row= $stmt->fetch(PDO::FETCH_ASSOC);

    if($row === false){
        return false;
    }
    else {
        return true;
    }

} 

function killToken($token) {
    global $pdo;   
    $stmt = $pdo->prepare("delete from token where token_value = ?");
    $stmt->execute([$token]);
}

function getIDUser_Token($token) {
    global $pdo;   
    $stmt = $pdo->prepare("Select user_id from token where token_value = ? and destroy_time > now()");
    $stmt->execute([$token]);
    $row= $stmt->fetch(PDO::FETCH_ASSOC);

    if(tokenExists($token)) {
        killToken($token);
    }

    if($row === false) {
        return "";
    }
    else {
        return $row['user_id'];
    }
}

function insertToken($token,$id,$type) {
    global $pdo;   
    $stmt = $pdo->prepare("INSERT INTO token (user_id, token_value, token_type) VALUES (?, ?, ?)");
    $stmt->execute([$id,$token,$type]);
}

function getStatusFromEmail($email) {
    global $pdo;   
    $stmt = $pdo->prepare("SELECT user_status FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row === false) {
        return "";
    }
    else {
        return $row['user_status'];
    }
}

function getIdFromEmail($email) {
    global $pdo;   
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row === false) {
        return "";
    }
    else {
        return $row['id'];
    }
}

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