<table class=changeMyNickname>
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

$Nickname =$_GET['Nickname'];

$checkquery ="select Nickname from profile where id='".$user1."'and Nickname ='".$Nickname."'";
$check = mysqli_query($conn,$checkquery);
$checksum = mysqli_num_rows($check);//같은 이름인지 확인

$update = "update profile set Nickname = '".$Nickname."' where id='".$user1."'"; // 친구목록에서 이름 수정

if(!$checksum){
if($conn->query($update)===TRUE)
	{
		echo "나의 별명을 ".$Nickname."으로 변경했습니다.";		
	}
}else
{
	echo"같은 이름입니다.";
}
$conn->close();
?> 
