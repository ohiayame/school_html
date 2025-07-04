<?php
    // 빛의 속도 (상수)
    const Light = 300000;

    $planet = $_POST['planet'];
    //  태양에서 수성까지 거리: 약 5,790만km
    if($planet == 'mercury'){
        $distance = 57900000;
    }
    // 태양에서 지구까지 거리: 약 1억 5천만km
    elseif($planet == 'earth'){
        $distance = 150000000;
    }
    // 태양에서 화성까지 거리: 약 2억 3천만km
    else{
        $distance = 230000000;
    }

    // 시간 계산
    $minutes = ($distance / Light) * (1/60);
    $minutes = round($minutes, 2);
    // 출력
    echo "Trave time from Sun to {$planet} : {$minutes} minutes";
?>