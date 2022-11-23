<?php
$servername = "localhost";
$username = "root";
$password = "tomtom";
$dbname = "ysk";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "delete from profile where uid>0";
$sql2 ="alter table profile auto_increment=1";
$sql3 = "insert into profile(id,password, name,message, phone,day,birthday,Nickname) values('root','root', 'root','관리자','1234',sysdate(),'000111','root')";
if ($conn->query($sql) === TRUE) {
  echo "데이터 삭제 완료<br>";
}
if ($conn->query($sql2) === TRUE) {
  echo "Auto_Increment 초기화<br>";
}
if ($conn->query($sql3) === TRUE) {
  echo "root계정 가입 완료";
}
$conn->close();
?>
