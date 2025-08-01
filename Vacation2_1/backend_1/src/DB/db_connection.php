<?php
require_once("./db_conf.php");

// MySQLi 에러 처리 방식 설정
// MYSQLI_REPORT_STRICT : 예외 발생 (mysqli_sql_exception)
// MYSQLI_REPORT_ERROR  : 경고(warning) 출력
// MYSQLI_REPORT_OFF    : 오류 보고 없음 (false 반환)
// MYSQLI_REPORT_ALL    : STRICT + ERROR 조합
mysqli_report(MYSQLI_REPORT_ALL);


try {
    // 1. 연결 설정
    $db_conn = new mysqli(DB_INFO::DB_HOST, DB_INFO::DB_USER, DB_INFO::DB_PW, DB_INFO::DB_NAME);

    // 2. 연결 설정
    $sql = "select * from student";
    $result = $db_conn->query($sql);

    // 3. 반환 값 처리
    // 레코드 단위
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $key => $value) {
            echo $key . ": " . $value . "<br>";
        }
    }

} catch (Exception $ex) {
    echo $ex->getMessage();
} finally {
    
}





// 4. 연결 종료
$db_conn->close();
