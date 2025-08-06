<?php
session_start();
require_once('./db_conf.php');

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $username_raw = trim($_POST['username'] ?? '');
    $password_raw = trim($_POST['password'] ?? '');

    $username = $conn->real_escape_string($username_raw);
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if($result && $row = $result->fetch_assoc()){
        if(password_verify($password_raw, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];

            header("Location: welcome.php");
            exit;
        }else{
            throw new Exception('비밀번호가 다릅니다.');
        }
    }else{
        throw new Exception('아이디가 존재하지 않습니다.');
    }

}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: login.php");
    exit;
}