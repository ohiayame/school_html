<?php
// 경고 무시
mysqli_report(MYSQLI_REPORT_OFF);

// db연결
require_once('./db_conf.php');

$db_conn = new mysqli(
    db_info::DB_URL, db_info::USER_ID, db_info::PASSWD, db_info::DB
);

// 연결확인
if($db_conn->connect_errno){
    // 오류발생 시 회원가입 돌아가기
    $_SESSION['error'] = "DB 연결 실패";
    header("Location: register.php");
    exit;
}
// post로 받은 정보를 변수에 대입
$username_raw = trim($_POST['username'] ?? '');
$password_raw = trim($_POST['password'] ?? '');
$nicname_raw  = trim($_POST['nicname'] ?? '');

// 내용이 존재하는지 확인
if($username_raw === '' || $password_raw === '' || $nicname_raw === ''){
    // 없으면 error설정하고 돌아가기
    $_SESSION['error'] = "정보를 입력하세요";
    header("Location: register.php");
    exit;
}

// 비밀번호 해싱 처리
$password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);

// 이스케이프 처리  /  $db_conn->real_escape_string()
$username = $db_conn->real_escape_string($username_raw);
$password = $db_conn->real_escape_string($password_hashed);
$nicname = $db_conn->real_escape_string($nicname_raw);


// 정보 저장 sql문  
$sql = "
    INSERT INTO users (username, password, name)
    VALUES ('$username', '$password', '$nicname')
";

// 저장이 성공하면
if($db_conn->query($sql)){
    // db 연결 종료
    $db_conn->close();
    // session 'success' 저장하고 login페이지 이동
    $_SESSION['success'] = "회원가입이 완료되었습니다";
    header("Location: login.php");
    exit;
}else{// 에러 나면
    // 중복 아이디(1062)-> 오류 메시지 저장
    if($db_conn->errno === 1062){
        $_SESSION['error'] = "이미 사용 중인 아이디입니다.";
    }else{
        // 이외 에러 -> 로그 남기기
        $_SESSION['error'] = "회원가입 실패";
        error_log("[REGISTER ERROR]" . $db_conn->errno);
    }
    // db연결 종료
    $db_conn->close();
    // 회원가입페이지 돌아가기
    header("Location: register.php");
    exit;
}
?>