<?php
// 1. 생성 요청 (App S)
echo "something";
setcookie("bar", "milk");
// bar = milk
setcookie("foo", "beer");
setcookie("pos", "water");
setcookie("kin", "cider", time() - 3600);

// 2. 생성 (C)

// 3. 전달 (C)

// 4. 읽기 (App S)

?>