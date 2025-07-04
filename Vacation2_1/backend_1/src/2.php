<?php
// 연산자

// 1) 기능
// 2) 우선순위
// 3) 이항연산 시 묵시적 형변환 규칙

// 비교연산자
// $bar = 1;
// $foo =  1.0;

// if($bar == $foo)
//     echo "True";
// else    
//     echo "False";


// print_r(1<=>1);
// print_r(2<=>1);
// print(1<=>2);

// $my_aray = [10, 1, 5, 90,3];
// usort($my_aray, function($a, $b){
//     return $a <=> $b;
//     // if($a == $b){
//     //     return 0;
//     // }else{
//     //     return $a < $b ? 1: -1;
//     // }
// });
// var_dump($my_aray);

// $resut_1 = true && false;
// $resut_2 = true and false;
// var_dump($resut_1); // bool(false)
// var_dump($resut_2); // bool(true)

// echo "1" + "222ff";  // -> 223이 나옴 (숫자로 처리)
// echo "1"."222ff";

// @include 'agukjhfal.php';

// echo `ls -la`;

// $bar = [1, 2, 3];
// $foo = array(1, 2, 3);

// if($bar == $foo)
//     echo "True";
// else    
//     echo "False";

// $bar = [1, 2, 3];
// var_dump($bar);

// $bar = [1, 2, 3];
// $foo = [1, 2=> 3, 1 => 2];

// if($bar === $foo)
//     echo "True";
// else    
//     echo "False";



// foreach문
// $bar = [10, 20, 100];

// foreach ($bar as $key => $val){
//     echo $key.":".$val . "<br>";
// }



// 모듈
// include('my_util.phppp');
// // require('my_util.phppp');
// echo "<br>hello<br>"; 

// sum(1, 2);

// require_once('my_util.php');
// require_once('my_util.php');
// require_once('my_util.php');

// sum(1, 2);


// function bar($a){
//     $a = 100;
// }
// $foo = 3;
// bar($foo);
// echo $foo;

// function bar($a, &$b){
//     $a = 900;
//     $b = 30;
// }

// $my_li = [3, 10, 100];
// bar($my_li[0], $my_li[1]);
// var_dump($my_li) 
// // array(3) { [0]=> int(3) [1]=> int(30) [2]=> int(100) }



// closure 함수
// $foo = 2;
// // foo -> 캡쳐 발생
// $bar = function () use ($foo){
//     echo $foo;
// };
// $foo = 10;
// $bar();




?>