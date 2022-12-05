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

$update2 ="update posting set name = '".$Nickname."' where id ='".$user1."'"; // 게시판에서 이름 수정

$update3 ="update comment set Nickname = '".$Nickname."' where id ='".$user1."'"; // 댓글에서 이름 수정

$result = "select user2Nickname from friends where user2= '".$user1."'";
$checkname = mysqli_query($conn,$result);
	foreach($checkname as $cn){
		$result2 = "select Nickname from profile where Nickname ='".$cn['user2Nickname']."'";
		$checkname2 =mysqli_query($conn,$result2);
			foreach($checkname2 as $cn2)
				$update2 = "update friends set user2Nickname ='".$Nickname."' where user2='".$user1."'and user2Nickname='".$cn2['Nickname']."'";
}
if(!$checksum){ // 입력값이 나의 현재 이름과 같은 값이 아닐경우
if(($conn->query($update)===TRUE)&&($conn->query($update2)===TRUE)&&($conn->query($update3)===TRUE))// 친구목록, 게시글, 댓글에서 나의 이름을 모두 수정한다.
	{
		echo "나의 별명을 ".$Nickname."으로 변경했습니다.";		
	}
}else // 입력값이 나의 현재 이름과 같은값일 경우
{
	echo"같은 이름입니다.";
}
$conn->close();
?> 
