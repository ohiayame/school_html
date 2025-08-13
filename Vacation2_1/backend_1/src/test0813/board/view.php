<?php
    session_start();
    require_once('../db_conf.php');

    $id = (int)$_GET['id'];
    
    try{
        $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
        $conn->set_charset('utf8mb4');

        $sql = "
        SELECT p.title, p.content, p.user_id, p.views, p.created_at, p.updated_at, u.name AS author
        FROM posts p JOIN users u ON p.user_id = u.id
        WHERE p.id = $id
        ";
        $result = $conn->query($sql);
        if(!$result || $result->num_rows === 0){
            throw new Exception("해당 글이 없습니다.");
        }

        $post = $result->fetch_assoc();

        $view_sql = "
        UPDATE posts SET views = views + 1 WHERE id = $id
        ";
        $conn->query($view_sql);

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
    <h1><?= htmlspecialchars($post['title'])?></h1>
    <?php
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>". htmlspecialchars($_SESSION['error']) ."</p>";
            unset($_SESSION['error']);
        }
    ?>
    <p>작성자: <?=htmlspecialchars($post['author'])?></p>
    <p>작성일: <?=htmlspecialchars(date('Y-m-d H:i:s', strtotime($post['created_at'])))?></p>
    <?php
    if(!empty($post['updated_at'])){
        echo "<p>수정일: ". htmlspecialchars(date('Y-m-d H:i:s', strtotime($post['updated_at'])))."</p>";
    }
    ?>
    <p>조회수: <?=htmlspecialchars($post['views'])?></p>
    <br>
    <div>내용: <pre>
    <?=nl2br(htmlspecialchars($post['content']))?></pre></div>

    <p><a href="list.php">돌아가기</a></p>
    <?php 
    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] === $post['user_id']){
        echo"
        <p><a href='edit.php?id={$id}'>수정하기</a></p>
        <p><a href='delete.php?id={$id}' onclick=\"return confirm('게시글을 삭제합니까??');\">삭제하기</a></p>
    ";
    }
    ?>

</body>
</html>