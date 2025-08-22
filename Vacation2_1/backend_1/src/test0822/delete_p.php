<?php
session_start();
require_once('./db_conf.php');

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $id = (int)$_POST['id'] ?? '';
    $password = trim($_POST['password'] ?? '');

    if($password === ''){
        throw new Exception('비밀번호를 입력 해주세요.');
    }

    $check_sql = "
    SELECT password FROM posts WHERE id = $id";
    $check = $conn->query($check_sql);
    $row = $check->fetch_assoc();

    if(!password_verify($password, $row['password'])){
        throw new Exception("비밀번호가 일치하지 않습니다.");
    }

    $sql = "
        DELETE FROM posts WHERE id = $id
    ";
    $conn->query($sql);

    header("Location: list.php");
    exit;
}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: list.php");
    exit;
}
?>