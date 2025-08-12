<?php
session_start();
require_once('./db_conf.php');

try{
    $id = $_POST['id']??'';
    $password = $_POST['password'] ??'';

    if($id === '' || $password === ''){
        throw new Exception("비밀번호를 입력해주세요");
    }

    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $check_sql = "
        SELECT password FROM posts WHERE id=$id
    ";
    $check = $conn->query($check_sql);
    $post = $check->fetch_assoc();
    if(password_verify($password, $post['password'])){
        $sql = "
            DELETE FROM posts WHERE id=$id
        ";
        $conn->query($sql);
        header("Location: list.php");
        exit;
    }else{
        throw new Exception("비밀번호가 일치하지 않습니다.");
    }
}catch (Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: delete.php?id=$id");
    exit;
}

