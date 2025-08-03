<?php
require_once('./b_config.php');
try {
    // db연결
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conn->set_charset("utf8mb4");

    $sql = "
        SELECT id, name, title, created_at
        FROM posts
        ORDER BY id DESC
    ";
    $posts = $conn->query($sql);
} catch (Exception $e){
    error_log('[' . date('Y-m-d H:i:s') . '] ' . 
        $e->getMessage() . PHP_EOL, 3, LOG_FILE_PATH
    );
    $_SESSION['error'] = '게시글 목록을 불러오는 중 오류가 발생했습니다.';
}finally{
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board</title>
</head>
<body>
    <h1>Board</h1>
    <!-- error -->
    <?php
        if (isset($_SESSION['error'])) {
            echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
    ?>
    <table border="1" cellpadding="8" cellspecing="0">
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
        <!-- 개시글리 있으면 출력 -> 없으면 없다고 출력 -->
            <?php
                if (!empty($posts) && $posts instanceof mysqli_result) {
                    while ($post = $posts->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($post['id']) . "</td>";
                        echo "<td><a href='view.php?id=" . urlencode($post['id']) . "'>" . htmlspecialchars($post['title']) . "</a></td>";
                        echo "<td>" . htmlspecialchars($post['name']) . "</td>";
                        echo "<td>" . htmlspecialchars(date('Y-m-d', strtotime($post['created_at']))) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>게시글이 없습니다.</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <!-- page -->

    <!-- 글쓰기 -->
    <p><a href="b_write.php">글쓰기</a></p>
</body>
</html>