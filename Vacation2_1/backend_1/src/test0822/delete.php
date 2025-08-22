<?php
session_start();
require_once('./db_conf.php');

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $id = $_GET['id'];

    $sql = "
        SELECT title, name FROM posts WHERE id = $id
    ";
    $result = $conn->query($sql);
    if(!$result || $result->num_rows === 0){
        throw new Exception('해당 게시글이 없습니다.');
    }
    $post = $result->fetch_assoc();
}catch (Exception $e){
    $_SESSION['error'] = $e->getMessage();
    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>삭제하기</title>
</head>
<body>
    <h1><?=htmlspecialchars($post['title'])?> - 삭제하기</h1>
    <p>작성자: <?=htmlspecialchars($post['name'])?></p>
    <form action="delete_p.php" method="post">
        <input type="text" name="id" value="<?=$id?>" hidden>
        <label for="password">비밀번호 확인:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="삭제하기">
    </form>
</body>
</html>