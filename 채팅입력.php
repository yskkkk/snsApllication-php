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

$value1 = $user1."_".$user2; //채팅방 이름
$value2 = $user2."_".$user1; //채팅방 이름

$checkblock = "select * from friends where user1='".$user1."' and user2='".$user2."'";

$check = mysqli_query($conn,$checkblock);
$checksum= mysqli_num_rows($check); // 차단되었는지 확인

$message = $_GET['message']; // 메세지

$chatting1 = "insert into ".$value1."(name, message, time, view) values('".$user1."','".$message."',now(),1)";
$chatting2 = "insert into ".$value2."(name, message, time, view) values('".$user1."','".$message."',now(),1)";

$count = "update chatlist set count =count+1 where chatname='".$value2."'";
$time = "update chatlist set time =now() where chatname='".$value2."'";
$time2 = "update chatlist set time =now() where chatname='".$value1."'";

if($checksum){
	if(($conn->query($chatting1)===TRUE)&&($conn->query($chatting2)===TRUE)&&($conn->query($count)===TRUE)&&($conn->query($time)===TRUE)&&($conn->query($time2)===TRUE)) 
		{
			echo$message." 전송완료";
		}
}else
{
	if($conn->query($chatting1)===TRUE)
		{
			echo"차단한 상대입니다. 상대방은 메세지를 볼 수 없습니다.";
		}	
}
$conn->close();
?> 
