<table class=chatinfo>
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
//chatname = $_GET['chatname'];
$users1 = $user1."_".$user2; //유저의 채팅방
$users2 = $user2."_".$user1; //유저의 채팅방

$view = "update ".$users2." set view=0"; //samron3_younghan2396
$count = "update chatlist set count=0 where chatname='".$users1."'";
$chatcontents = $conn->query("select * from ".$users1." order by count desc");
$chatcount = mysqli_num_rows($chatcontents);


$searchquery = "select * from information_schema.tables where table_name= '".$users2."'";
$search = mysqli_query($conn,$searchquery);
$checksum = mysqli_num_rows($search);

if($checksum){
mysqli_query($conn, $view);
if(($conn->query($view)===TRUE)&&($conn->query($count)===TRUE))// view와 count 값을 0으로 초기화시켜준다.
{
	 foreach ($chatcontents as $chat){ 
		echo $chat['count']."::".$chat['id']."::".$chat['name']."::".$chat['message']."::".$chat['time']."::".$chat['view']."&<br>";// 채팅내용을 보여준다.
		}
}else{
}
}else
{
	foreach ($chatcontents as $chat){ 
		echo $chat['count']."::".$chat['id']."::".$chat['name']."::".$chat['message']."::".$chat['time']."::".$chat['view']."&<br>";// 채팅내용을 보여준다.
		}
}
$conn->close();
?> 


