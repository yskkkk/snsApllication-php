<table class=chatlist>
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

$chatlist = $conn->query("select * from chatlist where chatname like '".$user."\_%' order by time desc");
$chatcount = mysqli_num_rows($chatlist);


	 foreach ($chatlist as $cl){ 
		echo $cl['chatid']."::".$cl['chatname']."::".$cl['time']."&<br>";
		}

$conn->close();
?> 
