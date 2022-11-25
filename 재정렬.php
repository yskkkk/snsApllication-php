<table class=reload>
<td>
<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "tomtom";
$dbname = "ysk";
$checksum=0; //오류 체크를 하기 위한 checksum
// 접속 생성
$conn = new mysqli($servername, $username, $password, $dbname);
// 접속 체크
if ($conn->connect_error) {
  die("접속 오류: " . $conn->connect_error);
}
$value = $_GET['table'];
$query = "set @cnt=0";
$query2 ="update ".$value." set ".$value.".uid = @cnt:=@cnt+1";

if(($conn -> query($query)===TRUE)&&($conn -> query($query2)===TRUE))
{
	echo $value."테이블 uid 재정렬 완료.";
}
$conn->close();
?> 
