<table class=blacktlist>
<td>
<?php
error_reporting(0);
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
$user2= $_GET['user2'];

$searchblacklistquery = "select user2 from blacklist where user1= '".$user1."'";
$check= mysqli_query($conn,"select * from blacklist where user1= '".$user1."' and user2 = '".$user2."'");
$checksum= mysqli_num_rows($check);

$searchblacklist = mysqli_query($conn,$searchblacklistquery);
if($user2==""){
	 foreach ($searchblacklist as $sbl){ 
		$result = mysqli_query($conn,"select id,name from profile where id= '".$sbl['user2']."'");
			foreach($result as $r)
			{
				echo $r['id']."::".$r['name']."///";
			}
	}
}else{
$deleteblacklistquery="delete from blacklist where user2='".$user2."'";
	if(($conn->query($deleteblacklistquery)===TRUE)&&$checksum)
		{
			echo $user2."의 차단이 해제되었습니다.";
		}
	else
	{
		echo "차단목록에 없는 사용자 입니다.";
	}
}
$conn->close();
?> 