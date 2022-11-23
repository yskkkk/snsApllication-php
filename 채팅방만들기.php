<table class =makechat>
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

$value1=$_GET['user1']."_".$_GET['user2']; //채팅방 이름
$value2=$_GET['user2']."_".$_GET['user1']; //채팅방 이름 

$createtable1 = "create table ".$value1."( count int not null auto_increment, name varchar(20) not null, message varchar(200),time varchar(20),view int,primary key(count))engine=myisam charset=utf8";
$createtable2 = "create table ".$value2."( count int not null auto_increment, name varchar(20) not null, message varchar(200),time varchar(20),view int,primary key(count))engine=myisam charset=utf8";

$existcheck1 = "select chatname from chatlist where chatname='".$value1."'"; 
$existcheck2 = "select chatname from chatlist where chatname='".$value2."'"; // user2의 채팅이 있는지 확인

$insertchatlist1="insert into chatlist(chatname,time,count) values('".$value1."',sysdate(),0)";
$insertchatlist2="insert into chatlist(chatname,time,count) values('".$value2."',sysdate(),0)";

$existResult1 = mysqli_query($conn,$existcheck1); //  용수의 영한이와의 채팅방이 있는지 여부를 확인함
$checknum1 = mysqli_num_rows($existResult1) ;// 채팅방이 있는지 여부를 불러온 데이터의 컬럼 수로 파악 0일 경우 없음

$existResult2 = mysqli_query($conn,$existcheck2); //  영한의 용수와의 채팅방이 있는지 여부를 확인함
$checknum2 = mysqli_num_rows($existResult2) ;// 채팅방이 있는지 여부를 불러온 데이터의 컬럼 수로 파악 0일 경우 없음

if($checknum1==0) // 용수_영한의 채팅방이 없다.
{
	if($checknum2==0)//영한이가 없다
	{
		if(($conn->query($insertchatlist1)===TRUE)&&($conn->query($insertchatlist2)===TRUE)&&($conn->query($createtable1)===TRUE)&&($conn->query($createtable2)===TRUE))
		{
			echo"새로운 채팅방이 생성되었습니다.";
		}
	}else  //영한이가 있다
	{
		if(($conn->query($insertchatlist1)===TRUE)&&($conn->query($createtable1)===TRUE))
		{
			echo $_GET['user2']."와의 채팅을 시작합니다.";
		}
	}
		
}
else{ //용수_영한의 채팅방이 있다.
	if($checknum2==0)
	{
		if(($conn->query($createtable2)===TRUE)&&($conn->query($insertchatlist2)===TRUE)){
			echo $_GET['user2']."를 초대하였습니다.";
		}
	}else
	{
		echo "이미 채팅방이 있습니다.";
	}
}

$conn->close();
?> 


