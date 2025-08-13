<?php
session_start();
require_once('../db_conf.php');

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $username_raw = trim($_POST['username'] ?? '');
    $name_raw = trim($_POST['name'] ?? '');
    $password_raw = trim($_POST['password'] ?? '');

    if($username_raw === '' || $name_raw === '' || $password_raw === ''){
        throw new Exception('정보를 모두 입력해주세요.');
    }

    $username = $conn->real_escape_string($username_raw);
    $check_sql = "
        SELECT * FROM users WHERE username = '$username'
    ";
    $result = $conn->query($check_sql);
    if($result && $result->num_rows > 0){
        throw new Exception("이미 존재하는 아이디입니다.");
    }

    $name = $conn->real_escape_string($name_raw);
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    $sql = "
        INSERT INTO users (username, name, password) VALUES ('$username', '$name', '$password')
    ";
    $conn->query($sql);

    $_SESSION['success'] = '회원가입 완료';
    header("Location: login.php");
    exit;

}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: register.php");
    exit;
}

?>