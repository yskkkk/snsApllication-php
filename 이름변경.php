<table class=changename>
<td>
<?php
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

$user = $_GET['user'];
$name = $_GET['name'];

$changename = "update profile set name ='".$name."' where id = '".$user."'";

	$result = mysqli_query($conn, $changename); // 이름을 변경한다.
		echo "이름을 ".$name."로 변경하였습니다.";

$conn->close();
?> 