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

// $sql = "delete from student where std_id='$std_id'";
$sql = "select * from student";

// 2-2 : SQL 전송 Client -> DBMS 서버
// $result 결과 값
// 1) true
// 2) Instance of mysqli_result class (record 집합)
// 3) false
$result = $db_conn->query($sql);

// 3번 작업 : 반환 값 처리
while($row = $result->fetch_assoc()) {
    foreach ($row as $key => $value) {
        echo $key.":".$value."<br>";
        echo "<br>";
    }
    // echo $row["std_id"] . "<br>";
    // echo $row["id"] . "<br>";
    // echo $row["name"] . "<br>";
    // echo $row["age"] . "<br>";
    // echo "<hr><br>";
}


// 4번 작업: 연결 종료
$db_conn->close();