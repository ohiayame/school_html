<?php
session_start();
require_once('./db_conf.php');

try{
    // db연결 
    $conn = new mysqli(db_info::DB_HOST,db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $title_raw = trim($_POST['title']) ?? '';
    $name_raw = trim($_POST['name']) ?? '';
    $password_raw = trim($_POST['password']) ?? '';
    $content_raw = trim($_POST['content']) ?? '';

    // 입력 내용 확인
    if($title_raw === '' || $name_raw === '' || $password_raw === '' || $content_raw === ''){
        throw new Exception('내용을 모두 입력해주세요');
    }
    $title = $conn->real_escape_string($title_raw);
    $name = $conn->real_escape_string($name_raw);
    $content = $conn->real_escape_string($content_raw);
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    $sql = "
    INSERT INTO posts (title, name, password, content) 
    VALUES ('$title', '$name', '$password', '$content')
    ";
    $conn->query($sql);

    header("Location: list.php");
    exit;
}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header('Location: write.php');
    exit;
}



