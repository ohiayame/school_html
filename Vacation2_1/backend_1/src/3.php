<?php
    // print_r($_POST);

    function http_response_error($msg){
        http_response_code(400);
        echo $msg."<br>";
        exit;
    }

    if ( !isset($_POST["id"]) || !isset($_POST["pw"])){
        http_response_error("입력 값을 확인하세요.");
    }
    $id = trim(($_POST["id"]));
    $pw = trim(($_POST["pw"]));

    var_dump($_POST);
    var_dump($pw);

    if(!is_numeric($pw)){
        http_response_error("파스워드는 숫자로 구성");
    }

    if($id === ''){
        http_response_error("id를 입력 하세요");
    }

    echo "입력값 검증 완료";
?>