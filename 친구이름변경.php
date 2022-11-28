<table class=changefriendNickname>
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

$Nickname =$_GET['Nickname'];

$checkquery ="select user2Nickname from friends where user1='".$user1."'and user2='".$user2."'and user2Nickname ='".$Nickname."'";
$check = mysqli_query($conn,$checkquery);
$exist = mysqli_num_rows($check);

$findfriends = "update friends set user2Nickname= '".$Nickname."' where user1='".$user1."' and user2= '".$user2."'"; // 친구목록에서 이름 수정
if(!$exist){
if(($conn->query($findfriends)===TRUE)&&($user2!=""))
	{
		echo $user2."님의 별명을 ".$Nickname."으로 변경했습니다.";		
	}
}else
{
	echo "같은 이름입니다.";
}
$conn->close();
?> 
