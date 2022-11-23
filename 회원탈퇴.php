<table class=deleteprofile>
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

$id=$_GET['id']; //회원 탈퇴 유저 이름 
$password=$_GET['password'];// 비밀번호

$autoCL ="alter table chatlist auto_increment=1";
$autoP ="alter table profile auto_increment=1";

$match = "select id from profile where id='".$id."'and password='".$password."'"; // 회원탈퇴를 하려는 사람이 본인인지 확인

$searchmatch = mysqli_query($conn,$match);
$checksum = mysqli_num_rows($searchmatch); //아이디의 존재 여부 확인

$deleteprofile = "delete from profile where id='".$id."'";// 회원탈퇴 쿼리

$deletechatlist = "delete from chatlist where id='".$id."'";// 채팅방 삭제 쿼리

$dropquery= "select CONCAT('DROP TABLE ', TABLE_SCHEMA, '.', TABLE_NAME, ';') FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME LIKE '".$id."\_%"."' AND TABLE_SCHEMA = 'ysk'";//채팅방 검색 쿼리

$chatquery="select chatname from chatlist where chatname like '".$id."\_%'";

$friendquery = "select * from friends where user2 ='".$id."'";

$deletequery = "delete from friends where user2='".$id."'";

$auto="alter table chatlist auto_increment=1";

$searchtable = mysqli_query($conn,$dropquery); //   채팅방테이블이 있는지 여부를 확인


$searchchat = mysqli_query($conn,$chatquery); //  채팅리스트에 있는지 여부를 확인
$checknum2 = mysqli_num_rows($searchchat) ; 

$searchfriend = mysqli_query($conn,$friendquery);
$checknum3 = mysqli_num_rows($searchfriend); // 친구리스트에서 검색


if($checksum){
	if(($conn->query($deleteprofile)===TRUE)&&($conn->query($autoP)===TRUE)){
	foreach($searchtable as $st) //채팅방테이블 검색을 하나씩 불러옴
	{
		if(($conn->query($st["CONCAT('DROP TABLE ', TABLE_SCHEMA, '.', TABLE_NAME, ';')"])===TRUE)&&($conn->query($autoP)===TRUE))
			{	
				echo $st["CONCAT('DROP TABLE ', TABLE_SCHEMA, '.', TABLE_NAME, ';')"]." 실행<br>";
			}
		
	}if($checknum3){// 친구목록에 id가 있는지 확인한다.
                        if($conn ->query($deletequery)===TRUE){
                                echo $friendquery."실행<br>";
                        }
        }
	if($checknum2){//채팅방리스트가 하나라도 있으면
		foreach($searchchat as $sc)// 채팅리스트에서 검색을 하나씩 불러옴 50
		{
			if(($conn->query("delete from chatlist where chatname ='".$sc['chatname']."'")===TRUE)&&($conn->query($autoCL)===TRUE))
				{
					echo $sc['chatname']." 실행<br>";
				}
		
		}
}

	echo"회원탈퇴가 완료되었습니다.";

}//프로필 지우기
}else
{
	echo"일치하는 회원정보가 없습니다.";
}

$conn->close();
?> 



