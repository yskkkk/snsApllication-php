<table class=chatinfo>
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

$user1 = $_GET['user1'];
$user2 = $_GET['user2'];

$user = $user1."_".$user2; //유저의 채팅방
$user2 = $user2."_".$user1; //유저의 채팅방


$view = "update ".$user." set view=0";
$view2 = "update ".$user2." set view=0";
$count = "update chatlist set count=0 where chatname='".$user."'";

$chatcontents = $conn->query("select * from ".$user." order by count");
$chatcount = mysqli_num_rows($chatcontents);


if(($conn->query($view)===TRUE)||($conn->query($view2)===TRUE)&&($conn->query($count)===TRUE))
{
	 foreach ($chatcontents as $chat){ 
		echo $chat['count']."::".$chat['name']."::".$chat['message']."::".$chat['time']."::".$chat['view']."&<br>";
		}
}else{
	echo"gd";
}
$conn->close();
?> 


<script language='javascript'>
  window.setTimeout('window.location.reload()',1000); 
 </script>
