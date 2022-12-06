<table class=searchuser>
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

$id= $_GET['id']; // 닉네임, 프로필 이미지, 상태 메세지, 


$searchprofile = "select * from profile where id='".$id."'";
$search = mysqli_query($conn, $searchprofile);
foreach($search as $s){
	echo $s['image']."::".$s['Nickname']."::".$s['message'];
}

$conn->close();
?> 