<?php
    session_start();
    require_once('./db_conf.php');
    try{
        $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
        $conn->set_charset('utf8mb4');

        $sql = "SELECT id, title, name, created_at FROM posts ORDER BY id DESC";
        $posts = $conn->query($sql);
    }catch (Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
</head>
<body>
    <h1>게시판</h1>
    <?php
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>". htmlspecialchars($_SESSION['error'])."</p>";
            unset($_SESSION['error']);
        }
    ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>id</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($posts) && $posts instanceof mysqli_result){
                    while($post = $posts->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($post['id']) . "</td>";
                        echo "<td><a href='view.php?id=". urlencode($post['id']) . "'>" . htmlspecialchars($post['title'])."</a></td>";
                        echo "<td>" . htmlspecialchars($post['name'])."</td>";
                        echo "<td>".htmlspecialchars(date('Y-m-d', strtotime($post['created_at']))) . "</td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
                }
            ?>
        </tbody>
    </table>
    <br>

    <p><a href="write.php">글쓰기</a></p>
</body>
</html>