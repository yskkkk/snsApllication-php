<table class=changechatname>
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
$chatroomname = $_GET['chatroomname'];

$value = $user1."_".$user2;


//사진 이름 상태메세지  기본 친구목록 , user2시 특정친구 검색

$findchatroom = "select chatname from chatlist where chatname = '".$value."'"; // 해당 채팅방이 존재하는지 여부 확인
$changechatroomname = "update chatlist SET roomname = '".$chatroomname."' where chatname='".$value."'";

$check = mysqli_query($conn,$findchatroom);
$checksum = mysqlI_num_rows($check);

$changechatname = "alter table chatlist ";

if($checksum){ // 채팅방이 존재하면
	if($conn->query($changechatroomname)===TRUE){
	echo "채팅방 이름을 '".$chatroomname."'으로 변경하였습니다.<br>";
	}
}else{
 echo "존재하지 않는 채팅방 입니다.";
}
$conn->close();
?> 
ex) user1=ys&user2=yh&chatroomname=컴퓨터공학
