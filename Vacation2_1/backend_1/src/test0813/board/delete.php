<?php
session_start();
require_once('../db_conf.php');
if(!isset($_SESSION['user_id'])){
    $_SESSION['error'] = '로그인 해주세요.';
    header("Location: list.php");
    exit;
}

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');
    $id = (int)$_GET['id'];
    $check_sql = "
        SELECT user_id FROM posts WHERE id = $id
    ";
    $result = $conn->query($check_sql);
    if(!$result || $result->num_rows === 0){
        throw new Exception("해당 글이 없습니다.");
    }

    $post = $result->fetch_assoc();

    if($_SESSION['user_id'] !== $post['user_id']){
        throw new Exception("삭제 권한이 없습니다.");
    }

    $sql = "DELETE FROM posts WHERE id=$id";
    $conn->query($sql);
    header("Location: list.php");
    exit;

}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header('Location: list.php');
    exit;
}
?>