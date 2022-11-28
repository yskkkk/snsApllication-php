<table class=chatlist>
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

$user = $_GET['user'];

$chatlist = mysqli_query($conn,"select * from chatlist where chatname like '".$user."\_%' order by time desc"); // chatlist
$chatcount = mysqli_num_rows($chatlist);

	 foreach ($chatlist as $cl){ 
		$message= mysqli_query($conn, "select * from ".$cl['chatname']." order by count desc limit 1"); 
		$img = mysqli_query($conn, "select * from profile where id ='".$cl['user2']."'");
		foreach($message as $m)
		foreach($img as $im)
		echo $im['image']."::".$cl['roomname']."::".$m['message']."::".$cl['count']."::".$cl['time']."&<br>";
		}

$conn->close();
?> 
