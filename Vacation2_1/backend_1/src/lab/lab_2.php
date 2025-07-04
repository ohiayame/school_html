<?php
    $val_li = $_POST['val'];
    $val_len = count($val_li);

    // 입력 값 출력
    echo "입력 값 : " . implode(" ", $val_li);
    $sum = array_sum($val_li);

    // 평균 출력
    $avg = $sum/$val_len;
    echo "<br>평균 : {$avg}";

    // 분산 출력
    $variance_x = 0;
    foreach($val_li as $val){
        // 제곱근은 pow (값, 乘)함수
        $variance_x += pow($val - $avg, 2);
    }
    $variance = $variance_x / ($val_len-1);
    echo "<br>분산 : {$variance}";

    // 표준편차 출력
    // 루트는 sqrt()함수
    $deviation = sqrt($variance);
    echo "<br>표준편차 : ". round($deviation, 2);

?>