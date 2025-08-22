<?php
session_start();
require_once('./db_conf.php');

try{
    $id = (int)$_GET['id'] ?? '';

    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $sql = "
        SELECT title, content, name, created_at, updated_at FROM posts WHERE id = $id
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
    <title>상세 보기</title>
</head>
<body>
    <h1><?= $post['title'] ?></h1>
    
    <?php
    if(isset($_SESSION['error'])){
        echo "<p style='color:red'>". htmlspecialchars($_SESSION['error'])."</p>";
        unset($_SESSION['error']);
    }
    ?>

    <p>작성자: <?= htmlspecialchars($post['name']) ?></p>
    <p>작성일: <?= htmlspecialchars(date('Y-m-d', strtotime($post['created_at']))) ?></p>
    <?php
    if(!empty($post['updated_at'])){
        echo "<p>수정일: ".htmlspecialchars(date('Y-m-d', strtotime($post['updated_at'])))."</p>";
    }
    ?>
    <div>내용: <pre>
        <?=htmlspecialchars($post['content'])?>
    </pre></div>

    <p><a href="list.php">돌아가기</a></p>

    <div>
        <p><a href="edit.php?id=<?=$id?>">수정하기</a></p>
        <p><a href="delete.php?id=<?=$id?>">삭제하기</a></p>
    </div>
</body>
</html>