<?php

$db_conn = new mysqli('db', 'root', 'root', 'gsc');

$sql = "select * from student";

$result = $db_conn->query($sql);

// while ($row = mysqli_fetch_assoc($result)) {
//   echo "<br>";
//   print_r($row);
//   echo "<br>";
// }

// while ($row = $result->fetch_assoc()) {
//   echo $row['std_id'] . "<br>";
//   echo $row['id'] . "<br>";
//   echo $row['name'] . "<br>";
//   echo $row['age'] . "<br>";
//   echo "<br><br>";
// }


while ($row = $result->fetch_assoc()) {
    foreac`h ($row as $key => $value) {
        echo $key . ": " . $value . "<br>";
    }
    echo `"<hr>";
}