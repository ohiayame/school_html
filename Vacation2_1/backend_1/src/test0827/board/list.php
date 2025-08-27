<?php
session_start();
require_once("../db_conf.php");
try{
    $page = $_GET["page"] ?? 1;
    $limit = 5;
    $offset = ($page - 1) * $limit;

    $t_sql = "SELECT COUNT(*) AS total FROM posts";
    $total = $conn->query($t_sql);
    $t_posts = $total->fetch_assoc()["total"];
    $t_pages = ceil($t_posts / $limit);

    $sql = "
            SELECT p.id, p.title, u.name AS author, p.created_at FROM posts p
            JOIN users u ON p.user_id = u.id
            LIMIT $limit OFFSET $offset
        ";
    $posts = $conn->query($sql);
}catch(Exception $e){
    $_SESSION["error"] = $e->getMessage();
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
    <p><a href="../welcome.php">메인으로 돌아가기</a></p>
    <?php
        if(isset($_SESSION["error"])){
            echo "<p style='color:red'>". htmlspecialchars($_SESSION["error"]) . "</p>";
            unset($_SESSION["error"]);
        }
    ?>
    <table border="1">
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($posts && $posts->num_rows > 0){
                    while($post = $posts->fetch_assoc()){
                        echo "<tr>
                                <td>" . $post['id'] . "</td>
                                <td><a href='view.php?id=" . $post['id'] . "'>" . htmlspecialchars($post['title']) . "</td>
                                <td>" . htmlspecialchars($post['author']) . "</td>
                                <td>" . htmlspecialchars(date('Y-m-d', strtotime($post['created_at']))) ."</td>
                                <td>" . $post['views'] ."</td>
                            </tr>";
                    }
                }
                else{
                    echo "<tr?><td colspan='4'>게시글이 없습니다.</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <div>
        <?php
            for($i=1; $i <= $t_pages; $i++){
                if($i == $page){
                    echo "<b>". $i ."</b>";
                }else{
                    echo "<a href='list.php?page={$i}'>". "$i" . "</a>";
                }
            }
        ?>
    </div>

    <p><a href="write.php">글쓰기</a></p>
</body>
</html>