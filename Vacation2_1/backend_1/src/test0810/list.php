<?php
    session_start();
    require_once('./db_conf.php');
    try{
        $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
        $conn->set_charset('utf8mb4');

        $sql = "SELECT id, title, name, create_at FROM posts";
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
    <table>
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
                if(!empty($posts)){
                    while($post = $posts->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".htmlspecialchars($post['id'])."</td>";
                        echo "<td><a href='view.php?id=".htmlspecialchars($post['id']).">".htmlspecialchars($post['title'])."</a></td>";
                        echo "<td>".htmlspecialchars($post['name'])."</td>";
                        echo "<td>".htmlspecialchars($post['create_at'])."</td>";
                    }
                }else{
                    echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <a href="write.php">글쓰기</a>
</body>
</html>