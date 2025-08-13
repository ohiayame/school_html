<?php
session_start();
require_once('../db_conf.php');

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $username_raw = trim($_POST['username'] ?? '');
    $password_raw = trim($_POST['password'] ?? '');

    if($username_raw === '' || $password_raw === ''){
        throw new Exception('정보를 모두 입력해주세요.');
    }

    $username = $conn->real_escape_string($username_raw);
    $check_sql = "
        SELECT id, name, password FROM users WHERE username = '$username'
    ";
    $result = $conn->query($check_sql);
    if(!$result){
        throw new Exception("존재하지 않는 아이디입니다.");
    }
    $row = $result->fetch_assoc();
    if(!password_verify($password_raw, $row['password'])){
        throw new Exception("비밀번호가 이리하지 않습니다.");
    }

    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $row['name'];

    header("Location: welcome.php");
    exit;

}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: register.php");
    exit;
}

?>