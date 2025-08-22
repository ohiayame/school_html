<?php
session_start();
require_once('./db_conf.php');
try{
    $id = (int)$_GET['id'];

    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $sql = "
        SELECT title, name, content FROM posts WHERE id = $id
    ";
    $result = $conn->query($sql);
    
    if(!$result || $result->num_rows === 0){
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
    <title>수정하기</title>
</head>
<body>
    <h1><?=htmlspecialchars($post['title'])?> - 수정하기</h1>
    <form action="edit_p.php" method="post">
        <fieldset>
            <legend>수정 폼</legend>
            <input type="text" name="id" value="<?=$id?>" hidden>
            <label for="title">제목:</label>
            <input type="text" name="title" value="<?=htmlspecialchars($post['title'])?>">
            <br>
            <label for="name">이름:</label>
            <input type="text" name="name" value="<?=htmlspecialchars($post['name'])?>" readonly>
            <br>
            <label for="password">비밀번호 확인:</label>
            <input type="password" name="password" required>
            <br>
            <div>내용:<br>
                <textarea name="content" ><?= htmlspecialchars($post['content'])?></textarea>
            </div>

            <input type="submit" value="수정">
        </fieldset>
    </form>

    <p><a href="view.php?id=<?=$id?>">취소</a></p>
</body>
</html>