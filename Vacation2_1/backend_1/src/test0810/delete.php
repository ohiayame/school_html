<?php
session_start();
require_once('./db_conf.php');

$id = $_GET['id'];

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $sql = "
        SELECT title, name FROM posts WHERE id='$id'
    ";
    $result = $conn->query($sql);
    if(!$result || $result->num_rows === 0){
        throw new Exception("게시글이 없숩니다.");
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
    <title>삭제</title>
</head>
<body>
    <h1><?=$id?> 글 삭제</h1>

    <?php
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>" . htmlspecialchars($_SESSION['error']) ."</p>";
            unset($_SESSION['error']);
        }
    ?>

    <form action="delete_p.php" method="post">
        <fieldset>
            <legend><?=$post['title']?> (<?=$post['name']?>) 삭제</legend>
            <input type="hidden" name="id" value="<?=$id?>">
            <label for="password"> 비밀버호 확인: </label>
            <input type="password" name="password" required>

            <input type="submit" value="삭제">
        </fieldset>
    </form>

    <p><a href="view.php?id=<?= $id?>">취소</a></p>
</body>
</html>