<?php
session_start();
require_once('./db_conf.php');

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $id = (int)$_GET['id'];
    $sql = "SELECT title, content, name, create_at, update_at FROM posts WHERE id='$id'";
    $result = $conn->query($sql);
    if(!$result){
        throw new Exception('해당 게시글이 없습니다.');
    }
    $post = $result->fetch_assoc();
}catch(Exception $e){
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
    <title>글보기</title>
</head>
<body>
    <h1><?=htmlspecialchars($post['title'])?> -글보기</h1>
    <b>작성자: </b><?=htmlspecialchars($post['name']) ?> ,  
    <b>작성일: </b><?=htmlspecialchars(date('Y-m-d H:i:s', strtotime($post['created_at'])));?>
    <?php
        if(!empty($post['update_at'])){
            echo "<b>작성일: </b>".htmlspecialchars(date('Y-m-d H:i:s', strtotime($post['created_at'])));
        }
    ?>

    <div>
        <?php echo nl2br(htmlspecialchars($result['content'])); ?>
    </div>
    
    <a href="list.php">돌아가기</a>
    <br>
    <a href="edit.php?id=<?= htmlspecialchars($post['id'])?>">수정</a>
    <a href="delete.php?id=<?= htmlspecialchars($post['id'])?>">삭제</a>
    
</body>
</html>