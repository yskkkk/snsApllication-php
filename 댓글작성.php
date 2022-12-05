<table class=postcomment>
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

$id= $_GET['id'];
$postuid = $_GET['postuid'];
$comment = $_GET['comment'];

$searchprofile = "select * from profile where id='".$id."'";
$search = mysqli_query($conn, $searchprofile);
foreach($search as $s){
$update = "insert into comment(postuid, image, Nickname, comment, time, id) value('".$postuid."', '".$s['image']."', '".$s['Nickname']."', '".$comment."', date_format(now(),'%H:%i'),'".$s['id']."')";
}

	if($conn-> query($update)===TRUE) //댓글을 작성한다.
	{
		echo "댓글을 작성하였습니다.";
	}


$conn->close();
?> 