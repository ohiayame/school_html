<?php

// db 라는 주소를 가지는 mysql에 접속
// 인증 ID : root
// 페스워드 : root
// 선택 DB : gsc


// 1번 작업: DBMS와의 연결 설정
$db_conn = new mysqli("db", "root", "root", "gsc");


// 연결 결과 확인
if ($db_conn->errno) {
    // 연결 실패 시 -> 프로그램 종료
    echo $db_conn->error;
    exit;
}

// 2번 작업 : SQL 전송

// 2-1 : SQL문 작성 -> 문자열을 이용하여 실행하고자 하는 SQL문 생성
$std_id = $_POST['std_id'];
$id = $_POST['id'];
$password = $_POST['password'];
$name = $_POST['name'];
$age = $_POST['age'];
$birth = $_POST['birth'];

$sql = "insert into student (std_id, id, password, name, age, birth)
        values ('$std_id', '$id', '$password', '$name', $age, '$birth')";

// 2-2 : SQL 전송 Client -> DBMS 서버
// $result 결과 값
// 1) true
// 2) INstance of mysqli_result class
// 3) false
$result = $db_conn->query($sql);

// 3번 작업 : 반환 값 처리
if ($result) {
    echo "<hr><br>레코드 생성 성공<br><hr>";
} else {
    echo "<hr><br>레코드 생성 실패<br><hr>";
};

// 4번 작업: 연결 종료
$db_conn->close();