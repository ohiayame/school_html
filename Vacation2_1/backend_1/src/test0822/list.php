<?php
session_start();
require_once('./db_conf.php');

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $t_sql = "SELECT COUNT(*) AS total FROM posts";
    $total = $conn->query($t_sql);
    $total_posts = $total->fetch_assoc()['total'];
    $total_pages = ceil($total_posts / $limit);

    $sql = "
        SELECT id, title, content, name, created_at FROM posts 
        ORDER BY id DESC LIMIT $limit OFFSET $offset
    ";
    $result = $conn->query($sql);
    
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
            echo "<p style='color:red'>" . htmlspecialchars($_SESSION['error'])."</p>";
            unset($_SESSION['error']);
        }
    ?>
    <table border='1' cellpadding="8">
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
                if($result && $result->num_rows > 0){
                    while($post = $result->fetch_assoc()){
                        echo "
                        <tr>
                        <td>{$post['id']}</td>
                        <td><a href='view.php?id={$post['id']}'>" . htmlspecialchars($post['title']) ."</a></td>
                        <td>".htmlspecialchars($post['name']) ."</td>
                        <td>".htmlspecialchars(date('Y-m-d', strtotime($post['created_at']))) . "</td>
                        ";
                    }
                }else{
                    echo "<tr><td colspan='4'>게시글이 없음</td></tr>";
                }
            ?>
        </tbody>
    </table>
    
    <div>
        <p>
        <?php
        for($i=1; $i <= $total_pages; $i++){
            if($i == $page){
                echo "<b>[{$i}]</b>";
            }else{
                echo "<a href='list.php?page={$i}'>[" . $i ."]</a>";
            }
        }
        ?>
        </p>
    </div>

    <p><a href="write.php">글쓰기</a></p>
</body>
</html>