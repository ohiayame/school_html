<?php
session_start();
require_once('./db_conf.php');

$title_raw = trim($_POST['title'] ?? '');
$content_raw = trim($_POST['content'] ?? '');
$name_raw = trim($_POST['name'] ?? '');
$password_raw = trim($_POST['password'] ?? '');

if($title_raw === '' || $content_raw === '' || $name_raw === '' || $password_raw === ''){
    $_SESSION['error'] = "내용을 모두 작성해주세요";
    header("Location: write.php");
    exit;
}


try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $password = password_hash($password_raw, PASSWORD_DEFAULT);
    $title = $conn->real_escape_string($title_raw);
    $content = $conn->real_escape_string($content_raw);
    $name = $conn->real_escape_string($name_raw);

    $sql = "
        INSERT INTO posts (title, content, name, password) 
        VALUES ('$title', '$content', '$name', '$password')
    ";
    $conn->query($sql);

    header("Location: list.php");
    exit;

}catch (Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: write.php");
    exit;
}

?>
