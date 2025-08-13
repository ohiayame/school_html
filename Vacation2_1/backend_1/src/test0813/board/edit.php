<?php
session_start();
require_once('../db_conf.php');
$id = (int)$_GET['id'];

if(!isset($_SESSION['user_id'])){
    $_SESSION['error'] = '로그인 해주세요.';
    header("Location: list.php");
    exit;
}
    
    try{
        $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
        $conn->set_charset('utf8mb4');

        $sql = "
        SELECT title, content, user_id FROM posts WHERE id = $id
        ";
        $result = $conn->query($sql);
        if(!$result || $result->num_rows === 0){
            throw new Exception("해당 글이 없습니다.");
        }

        $post = $result->fetch_assoc();
    
        if($_SESSION['user_id'] !== $post['user_id']){
            throw new Exception("수정 권한이 없습니다.");
        }
    }catch(Exception $e){
        $_SESSION['error'] = $e->getMessage();
        header("Location: view.php?id=$id");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>수정하기</title>
</head>
<body>
    <h1>수정하기</h1>
    <?php
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>". htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']);
        }
    ?>
    <form action="edit_p.php" method="post">
        <fieldset>
            <legend>게시글 수정</legend>
            <input type="hidden" name="id" value="<?=$id?>">
            <label for="title">제목: </label>
            <input type="text" name="title" value="<?=$post['title']?>" required>
            <br>
            <label for="content">내용: </label>
            <textarea name="content" required><?=$post['content']?></textarea>
            <br>
            <input type="submit" value="수정하기">
        </fieldset>
    </form>

    <p><a href="view.php?id=<?=$id?>">취소</a></p>
</body>
</html>