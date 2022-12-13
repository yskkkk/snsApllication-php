<table class=addfriend>
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

$addfriends = "INSERT INTO friends(user1,user2,user2Nickname) VALUES('".$user1."','".$user2."','')";
$addfriends2 = "INSERT INTO friends(user1,user2,user2Nickname) VALUES('".$user2."','".$user1."','')";
$checkfriends ="select user2 from friends where user1='".$user1."' and user2='".$user2."'"; // 친구목록에 등록되어있는지 확인

$checkprofile ="select id from profile where id='".$user2."'"; // 유효한 사용자인지 확인

$deleteblacklist ="delete from blacklist where user1='".$user1."' and user2 = '".$user2."'";

$checkblacklist = "select user2 from blacklist where user1= '".$user1."' and user2 = '".$user2."'";
$checkblack = mysqli_query($conn, $checkblacklist);
$checksum4 = mysqli_num_rows($checkblack); // 블랙리스트에 있는지 확인
$searchNickname ="select Nickname from profile where id='".$user2."'";// user2의 Nickname
$searchNickname2 = "select Nickname from profile where id='".$user1."'"; // user1의 Nickname


$check = mysqli_query($conn,$checkfriends);
$checksum = mysqli_num_rows($check); // 친구목록

$check2 = mysqli_query($conn,$checkprofile);
$checksum2 = mysqli_num_rows($check2); // 프로필

if($user2=="")
	{
		echo "상대방의 id를 입력해주세요.<br>";
	}
else{
	if($checksum2) //존재하는 회원인지 확인
		{	 
			if($checksum)
				{
					if($user1==$user2){
					//echo "자기 자신은 최고의 친구이죠";
					}else{
					echo "이미 등록된 사용자입니다.";
					}
				}
			else
				{
					$Nickname = mysqli_query($conn,$searchNickname);
					foreach($Nickname as $N){
						$updatequery = "update chatlist set roomname='".$N['Nickname']."', user2Nickname ='".$N['Nickname']."' where chatname ='".$user1."_".$user2."'";
						$query = "INSERT INTO friends(user1,user2,user2Nickname) VALUES('".$user1."','".$user2."','".$N['Nickname']."')";
						if(($conn->query($query)===TRUE)&&($conn->query($updatequery)===TRUE)){
						}
					}
					$Nickname = mysqli_query($conn,$searchNickname2);
					foreach($Nickname as $N){
						$query = "INSERT INTO friends(user1,user2,user2Nickname) VALUES('".$user2."','".$user1."','".$N['Nickname']."')";
						if(($conn->query($query)===TRUE)&&($conn->query($deleteblacklist))){
							
							echo$user2."님과 친구가 되었습니다.";
						}
					}
				
				}
		}
	else
		{	
			echo "존재하지 않는 사용자입니다.";
		}
}

$conn->close();
?>
