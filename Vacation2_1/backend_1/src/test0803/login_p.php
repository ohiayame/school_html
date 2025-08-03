<?php 
//  경고 등 무시
mysqli_report(MYSQLI_REPORT_OFF);

// db 접속
require_once('./db_conf.php');
$db_conn = new mysqli( db_info::DB_URL, db_info::USER_ID, db_info::PASSWD, db_info::DB);

// db접속 확인 connect_errno
if($db_conn->connect_errno){
    // -> 오류 발생시 session'error'에 내용 저장 
    $_SESSION['error'] = 'DB 연결 실패';
    // -> 로그인 처리 페이지로 이동
    header("Locaton: login_p.php");
    exit;
}
// 사용자 이름과 비밀번호(_POST)의 변수를 선언 /  trim, 3항연산
$username_raw = trim($_POST['username'] ?? '');
$passwd_raw = trim($_POST['password'] ?? '');

// 내용이 있는지 검증
if($username_raw === '' || $passwd_raw === ''){
    // -> 내용이 없으면 session'error'에 내용 저장 
    $_SESSION['error'] = 'ID, PW를 입력하세요';
    // -> 로그인페이지로 이동
    header("Location: login.php");
    exit;
}   

// 사용자 이름과 동일 항목 찾아 해당 데이터 가져오기
$stmt = $db_conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username_raw);
$stmt->execute();
$result = $stmt->get_result();
// db연결 종료
$db_conn->close();

// 해당 정보가 있고 $row = $result->fetch_assoc()
if($result && $row = $result->fetch_assoc()){
    // 비밀번호 확인 일치하면
    if(password_verify($passwd_raw, $row['password'])){
        // 세션에 해당 아이디와 이름 저장
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['username'];
        // -> welcome로 이동
        header("Location: welcome.php");
        exit;
    }else{ // 비밀번호가 다르면
        // error를 저장하고 로그인으로 돌아가기
        $_SESSION['error'] = "비밀번호가 틀렸습니다.";
        header("Location: login.php");
        exit;
    }
}else{
    // 아아디가 없으면 error저장하고 로그인 돌아가기
    $_SESSION['error'] = "아이디가 존재하지 않습니다.";
    header("Location: login.php");
    exit;    
}