<table class=writepost>
<td>
<?php
error_reporting(1);
$servername = "localhost";
$username = "root";
$password = "tomtom";
$dbname = "ysk";

// 접속 생성
$conn = new mysqli($servername, $username, $password, $dbname);
// 접속 체크
if ($conn->connect_error) {
  die("접속 오류: " . $conn->connect_error);
}
$user = $_GET['user'];
$postimage = $_GET['postimage'];
$contents =$_GET['contents'];

$searchNickname = "select * from profile where id ='".$user."'";

$Nickname = mysqli_query($conn,$searchNickname);
	foreach ($Nickname as $n){
		$query = "insert into posting(id, image, postimage, user, contents, time) VALUES('".$user."','".$n['image']."','".$postimage."','".$n['Nickname']."','".$contents."',date_format(now(),'%c/%d %H:%i'))";
	}

if(($_GET['postimage']=="")||($_GET['user']=="")||($_GET['contents']=="")){// 파라미터가 비어있을경우
echo "값이 비어있습니다.";
}
else{

	if ($conn->query($query) === TRUE) {//게시글 등록
  	echo "게시글이 등록되었습니다.";
	}
}
$conn->close();
?>
