<table class=deletefriend>
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
$user1 = $_GET['user1'];
$user2 = $_GET['user2'];

$deletefriends = "delete from friends where user1='".$user1."'and user2='".$user2."'";
$deletefriends2 = "delete from friends where user1='".$user2."'and user2='".$user1."'";

$searchfriends = "select * from friends where user1='".$user2."'";

$check = mysqli_query($conn,$searchfriends);
$checksum = mysqli_num_rows($check); // 프로필

if(($conn->query($deletefriends)===TRUE)&&($conn->query($deletefriends2)===TRUE)&&$checksum)
	{
		echo $user2."님을 차단하였습니다.";
	}
else
	{
		echo "존재하지 않는 사용자 입니다.";
	}
$conn->close();
?>