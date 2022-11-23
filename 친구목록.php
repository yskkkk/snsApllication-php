<table class=friendlist>
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
$user2 = $_GET['user2'];

//사진 이름 상태메세지  기본 친구목록 , user2시 특정친구 검색

$friends = "select * from friends where user1='".$user1."'order by user2"; // 전체 친구 목록에서 user1의 친구를 찾음
$friends2 = "select * from friends where user1='".$user1."'and user2 like '%".$user2."%'order by user2"; // 전체 친구 목록에서 user1의 검색 user2를 찾음

$friendlist = $conn->query($friends); // 전체 친구 목록에서 검색

$friendsearch =$conn->query($friends2); //
$exist = mysqli_num_rows($friendsearch);

if($friendlist)
{
	if($user2=="")
		{
			foreach($friendlist as $fl)
					{
						$showfriends ="select * from profile where id='".$fl['user2']."'order by Nickname asc";
						$showfriendvalue = mysqli_query($conn,$showfriends);
						foreach($showfriendvalue as $sf)
							{
								echo  $sf['uid']."::".$sf['id']."::".$sf['name']."::".$sf['message']."::".$sf['image']."///";
							}
					}
	}else
		{	
			if($exist){
			$friends="select * from profile where id like '%".$user2."%' and id like (select user2 from friends where user2 like'%".$user2."%') order by id";
			$friendlist = $conn ->query($friends);
				foreach($friendlist as $fl)
					{	
						echo $fl['uid']."::".$fl['id']."::".$fl['name']."::".$fl['message']."::".$fl['image']."///";
					}
			}else
			{
				echo"일치하는 사용자가 없습니다.";
			}
		}
				
}
else{
	echo"친구를 만들어보세요";
}
$conn->close();
?> 
