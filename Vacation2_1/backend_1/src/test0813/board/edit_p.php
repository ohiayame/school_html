<?php
session_start();
require_once('../db_conf.php');


try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $id = (int)$_POST['id'];
    $title_raw = trim($_POST['title'] ?? '');
    $content_raw = trim($_POST['content'] ?? '');

    $title = $conn->real_escape_string($title_raw);
    $content = $conn->real_escape_string($content_raw);

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
    $conn->query($sql);

    header("Location: list.php");
    exit;

}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: edit.php?id=$id");
    exit;
}

?>