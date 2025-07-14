<?php

if (isset($_COOKIE['username'])){
    $username = htmlspecialchars($_COOKIE['username']);
    $rate = htmlspecialchars($_COOKIE['rate']);
    $coffe = htmlspecialchars($_COOKIE['coffe']);

    echo "<h1>음료 주문</h1>";
    echo "<b>{$username}</b>님의 주문 내용";
    echo "<ul>
            <li> 라떼: {$rate}잔</li>
            <li> 아이스 아메리카노: {$coffe}잔</li>";
    echo "<a href='lab2_2_edit_order.php'>주문 수정</a><br>";
    echo "<a href='lab2_2_delete_cookie.php'>주문 초기화</a>";

}else{
    echo '<form action="lab2_2_set_cookie.php" method="post">
            이름:<input type="text" name="username"><br>
            라떼 수량:<input type="text" name="rate"><br>
            아이스 아메리카노 수량:<input type="text" name="coffe"><br>
            <input type="submit" value="주문하기">
            </form>';
}