<?php
$servername = "localhost";
$username = "root";
$password = "tomtom";
$dbname = "ysk";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "delete from notice where uid>0";
$sql2 ="alter table notice auto_increment=1";
$sql3 = "INSERT INTO notice(title, contents, time) VALUES ('톡톡을 이용해주시는 여러분들께','톡톡을 이용해주셔서 감사합니다!',DATE_FORMAT(sysdate(), '%Y-%m-%d'))";
if ($conn->query($sql) === TRUE) {
  echo "데이터 삭제 완료<br>";
}
if ($conn->query($sql2) === TRUE) {
  echo "Auto_Increment 초기화<br>";
}
if ($conn->query($sql3) === TRUE) {
  echo "공지사항 게시 완료";
}
$conn->close();
?>
