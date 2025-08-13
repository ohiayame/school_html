<?php
session_start();
require_once('../db_conf.php');

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $title_raw = trim($_POST['title'] ?? '');
    $content_raw = trim($_POST['content'] ?? '');
    
    if($title_raw === '' || $content_raw === ''){
        throw new Exception("내용을 입력해주세요.");
    }
    
    $title = $conn->real_escape_string($title_raw);
    $content = $conn->real_escape_string($content_raw);
    $user_id = (int)$_SESSION['user_id'];

    $sql = "
        INSERT INTO posts (title, content, user_id) 
        VALUES ('$title', '$content', $user_id)
    ";
    $conn->query($sql);

    header('Location: list.php');
    exit;


}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: write.php");
    exit;
}


?>