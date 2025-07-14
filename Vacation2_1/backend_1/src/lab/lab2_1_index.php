<?php

if (isset($_COOKIE['username'])){
    $username = htmlspecialchars($_COOKIE['username']);
    echo "안녕하세요, {$username}님!<br>";
    echo "<a href='lab2_1_delete_cookie.php'>쿠키 삭제 </a>";
}else{
    echo '<form action="lab2_1_set_cookie.php" method="post">
            이름:<input type="text" name="username">
            <input type="submit" value="저장">
            </form>';
}