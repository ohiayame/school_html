<?php
session_start();
require_once('./db_conf.php');

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $title_raw = trim($_POST['title'] ?? '');
    $content_raw = trim($_POST['content'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $id = (int)$_POST['id'];

    if($title_raw === '' || $content_raw === '' || $password === ''){
        throw new Exception('내용을 모두 입력해주세요.');
    }

    $check_sql = "
        SELECT password FROM posts WHERE id = $id
    ";
    $check = $conn->query($check_sql);
    $row = $check->fetch_assoc();
    if(!password_verify($password, $row['password'])){
        throw new Exception('비밀번호가 일치하지 않습니다.');
    }
    $title = $conn->real_escape_string($title_raw);
    $content = $conn->real_escape_string($content_raw);

    $sql = "
        UPDATE posts SET
        title = '$title', content = '$content' WHERE id = $id
    ";
    $conn->query($sql);

    header("Location: view.php?id={$id}");
    exit;

}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: list.php");
    exit;
}
?>