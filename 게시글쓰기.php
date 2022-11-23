<table class=writepost>
<td>
<?php
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

$sql = "INSERT INTO posting(title, user, contents, time) VALUES ('".$_GET['title']."','".$_GET['user']."','".$_GET['contents']."',sysdate())";

if(($_GET['title']=="")||($_GET['user']=="")||($_GET['contents']=="")){
echo "값이 비어있습니다.";
}
else{

	if ($conn->query($sql) === TRUE) {
  	echo "새로운 데이터가 입력되었습니다.";
	}
	else {
 		echo "오류: " . $sql . "<br>" . $conn->error;
	      }
}
$conn->close();
?>
