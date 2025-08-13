<?php
session_start();
require_once('../db_conf.php');

try{
    $conn = new mysqli(db_info::DB_HOST, db_info::DB_USER, db_info::DB_PW, db_info::DB_NAME);
    $conn->set_charset('utf8mb4');

    $sql = "
        SELECT p.id, p.title, u.name AS author, p.created_at, p.views FROM posts p
        JOIN users u ON p.user_id = u.id
    ";
    $result = $conn->query($sql);
}catch(Exception $e){
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
        if(isset($_SESSION['user_id'])){
            echo "<p>안녕하세요 ". htmlspecialchars($_SESSION['name']) ."님!</p>";
            echo "<p><a href='../login/logout.php'>로그아웃</a></p>";
        }else{
            echo "<p><a href='../login/login.php'>로그인</a></p>";
        }
        if(isset($_SESSION['error'])){
            echo "<p style='color:red'>". htmlspecialchars($_SESSION['error']) ."</p>";
            unset($_SESSION['error']);
        }
    ?>
    <table border="1" cellpadding="8" cellspecing="0" >
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
                <th>조회수</th>
            </tr>
            <?php
                if($result){
                    if($result && $result->num_rows >0){
                        while($post = $result->fetch_assoc()){
                            echo "<tr>
                                <td>" . $post['id'] . "</td>
                                <td><a href='view.php?id=" . $post['id'] . "'>" . htmlspecialchars($post['title']) . "</td>
                                <td>" . htmlspecialchars($post['author']) . "</td>
                                <td>" . htmlspecialchars(date('Y-m-d', strtotime($post['created_at']))) ."</td>
                                <td>" . $post['views'] ."</td>
                                </tr>";
                        }
                    }
                }else{
                    echo "<tr><td colspan='5'>게시글이 없습니다.</td></tr>";
                }
            ?>
        </thead>
    </table>
    <?php
    if(isset($_SESSION['user_id'])){
        echo '<p><a href="./write.php">글쓰기</a></p>';
    }
    ?>
    <p><a href="../login/welcome.php">메인 페이지</a></p>
</body>
</html>