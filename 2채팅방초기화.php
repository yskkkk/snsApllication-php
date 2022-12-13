<?php
$servername = "localhost";
$username = "root";
$password = "tomtom";
$dbname = "ysk";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "delete from chatlist where chatid>0";
$sql2 ="alter table chatlist auto_increment=1";
if ($conn->query($sql) === TRUE) {
  echo "데이터 삭제 완료<br>";
}
if ($conn->query($sql2) === TRUE) {
  echo "Auto_Increment 초기화<br>";
}

$conn->close();
?>
