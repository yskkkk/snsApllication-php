<table class=deletefriend>
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
$user1 = $_GET['user1'];
$user2 = $_GET['user2'];

$deletefriends = "delete from friends where user1='".$user1."'and user2='".$user2."'";
$deletefriends2 = "delete from friends where user1='".$user2."'and user2='".$user1."'";

$addblacklist = "insert into blacklist(user1,user2) values('".$user1."','".$user2."')";

$searchblack = "select * from blacklist where user1='".$user1."' and user2 ='".$user2."'";
$check3 =mysqli_query($conn,$searchblack);
$checksum3 = mysqli_num_rows($check3);

$searchfriends = "select * from friends where user1='".$user2."'";
$searchprofile ="select * from profile where id='".$user2."'";

$check = mysqli_query($conn,$searchfriends);
$checksum = mysqli_num_rows($check); //친구목록에서 존재하는지 검색

$check2 = mysqli_query($conn,$searchprofile);
$checksum2 = mysqli_num_rows($check2); //친구목록에서 존재하는지 검색

if($checksum3){
	echo "이미 차단한 사용자 입니다.";
}else{
if($checksum)
	{	
		mysqli_query($conn, $deletefriends);
		mysqli_query($conn, $deletefriends2);
		mysqli_query($conn, $addblacklist);
		echo $user2."님을 차단하였습니다.";
	}
else if($checksum2)
	{
		echo "친구목록에 존재하지 않습니다.";
	}
else
	{
		echo "존재하지 않는 사용자 입니다.";
	}
}
$conn->close();
?>