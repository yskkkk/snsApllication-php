<table class = exitchat>
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

$value1=$_GET['user1']."_".$_GET['user2']; //채팅방 이름 

$existcheck1 = "select chatname from chatlist where chatname='".$value1."'"; // user1의 채팅이 있는지 확인

$deletetable1 = "delete from chatlist where chatname='".$value1."'";// chatlist 채팅 삭제 sql

$droptable1 = "drop table ".$value1;// chat table 삭제 sql

$auto="alter table chatlist auto_increment=1";

$existResult1 = mysqli_query($conn,$existcheck1); //  user1의 채팅방이 있는지 여부를 확인함
$checknum1 = mysqli_num_rows($existResult1) ; // 채팅방이 있는지 여부를 불러온 데이터의 컬럼 수로 파악 0일 경우 없음

if($checknum1==1){
	if(($conn->query($deletetable1)===TRUE)&&($conn->query($droptable1)===TRUE)&&($conn->query($auto)===TRUE))
	{	
		echo "채팅방에서 나갑니다.";
		
	}
}

$conn->close();
?> 
