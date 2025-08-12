<?php
session_start();
require_once('./db_conf.php');

$id = (int)$_GET['id'];

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $title_raw = trim($_POST['title'] ?? '');
    $content_raw = trim($_POST['content'] ?? '');
    $name_raw = trim($_POST['name'] ?? '');
    $password_raw = trim($_POST['password'] ?? '');

    if($title_raw === '' || $content_raw === '' || $name_raw === '' || $password_raw === ''){
        throw new Exception("모두 입력 해주세요");
    }

    // pw일치 확인
    $check_sql = "SELECT password FROM posts WHERE id = $id";
    $check = $conn->query($check_sql);
    if($check && $row = $check->fetch_assoc()){
        if(password_verify($password_raw , $row['password'])){
            $title = $conn->real_escape_string($title_raw);
            $content = $conn->real_escape_string($content_raw);
            $sql = "
                UPDATE posts SET title='$title', content='$content' WHERE id= '$id'
            ";
            $conn->query($sql);
            header("Location: list.php");
            exit;
        }else{
            throw new Exception("비밀번호가 일치하지 않습니다.");
        }
    }else{
        throw new Exception("게시글이 없습니다");
    }

}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: edit.php?id=$id");
    exit;
}