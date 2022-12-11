<table class=post>
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

$postuid = $_GET['postuid'];

$post = "select * from posting where uid = '".$postuid."'";
$printpost = mysqli_query($conn,$post);
foreach($printpost as $pp)
	{
		//echo $pp['uid']."::".$pp['title']."::".$pp['user']."::".$pp['contents']."::".$pp['time']."::".$pp['time']."<br><br>";//게시글 출력
	}
$comment = "select * from comment where postuid='".$postuid."'";
$comments = mysqli_query($conn,$comment);
	foreach($comments as $c)
		{
			echo $pp['uid']."::".$c['commentuid']."::".$c['image']."::".$c['Nickname']."::".$c['comment']."::".$c['time']."///<br>"; // 게시글의 댓글 출력
		}

$conn->close();
?> 