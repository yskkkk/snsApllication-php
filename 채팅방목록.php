<table class=chatlist>
<td>
<?php
error_reporting(1);
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

$searchquery= "select * from chatlist where roomname like '%".$user2."%' or user2Nickname like '%".$user2Nickname."%'";
$chatlist = mysqli_query($conn,"select * from chatlist where chatname like '".$user1."\_%' order by time desc"); // chatlist
$chatcount = mysqli_num_rows($chatlist);
if($user2==""){
	 foreach ($chatlist as $cl){ 
		$message= mysqli_query($conn, "select * from ".$cl['chatname']." order by count desc limit 1"); 
		$img = mysqli_query($conn, "select * from profile where id ='".$cl['user2']."'");
		foreach($message as $m)
		foreach($img as $im)
		echo $im['image']."::".$cl['roomname']."::".$m['message']."::".$cl['count']."::".$cl['time']."::".$im['id']."&<br>";
		}
}else if ($user2 !="")
{
	$chatlist = mysqli_query($conn,"select * from chatlist where chatname like '".$user1."\_%' and (user2Nickname like '%".$user2."%' or roomname like '%".$user2."%') and user2 != '".$user1."'  order by time desc");
	$checksum= mysqli_num_rows($chatlist);
	if($checksum){
	foreach ($chatlist as $cl){ 
		$message= mysqli_query($conn, "select * from ".$cl['chatname']." order by count desc limit 1"); 
		$img = mysqli_query($conn, "select * from profile where id ='".$cl['user2']."'");
		foreach($message as $m)
		foreach($img as $im)
		echo $im['image']."::".$cl['roomname']."::".$m['message']."::".$cl['count']."::".$cl['time']."::".$im['id']."&<br>";
		}
}else
	{
		echo "일치하는 채팅방이 없습니다.";
	}

}
$conn->close();
?> 
