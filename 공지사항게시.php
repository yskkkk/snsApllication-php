<table class=postnotice>
<td>
<?php
error_reporting(0);
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

$sql = "INSERT INTO notice(title, contents, time) VALUES ('".$_GET['title']."','".$_GET['contents']."',DATE_FORMAT(sysdate(), '%Y-%m-%d'))";

if(($_GET['title']=="")||($_GET['contents']=="")){
echo "값이 비어있습니다.";
}
else{
if ($conn->query($sql) === TRUE) {
  echo "공지사항이 등록되었습니다.";
} else {
  echo "오류: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>
