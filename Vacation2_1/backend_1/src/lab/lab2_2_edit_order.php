<?php

if (isset($_COOKIE['username'])){
    $username = htmlspecialchars($_COOKIE['username']);
    $rate = htmlspecialchars($_COOKIE['rate']);
    $coffe = htmlspecialchars($_COOKIE['coffe']);

    echo '<form action="lab2_2_update_cookie.php" method="post">
            이름:<input type="text" name="username" value="' . $username . '"><br>
            라떼 수량:<input type="text" name="rate"  value="' . $rate . '"><br>
            아이스 아메리카노 수량:<input type="text" name="coffe" value="' . $coffe . '"><br>
            <input type="submit" value="수정 완료">
            </form>
            ';
    echo "<a href='lab2_2_index.php'>뒤로가기</a>";

}else{
    header("Location: lab2_2_index.php");
    exit;
}