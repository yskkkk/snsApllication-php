<table class=post>
<td>
<?php
error_reporting(1);
$servername = 'localhost';
$username = 'root';
$password = 'tomtom';
$dbname = 'ysk';

$conn = new mysqli($servername, $username, $password, $dbname);

$user1= $_GET['user1'];
$user2= $_GET['user2name'];
$check =0;
if($user2==""){// user2의 값이 비어있을경우 user1의 id값에 해당하는 게시글들만 불러온다
$friendquery = "select user2 from friends where user1='".$user1."'union select '".$user1."'";
$friend = mysqli_query($conn, $friendquery);

foreach($friend as $f){
	$searchpostquery = "select * from posting where id = '".$f['user2']."'order by uid desc";
	$searchpost = mysqli_query($conn, $searchpostquery);
		foreach($searchpost as $sp)
			 echo $sp['uid']."::".$sp['id']."::".$sp['image']."::".$sp['postimage']."::".$sp['user']."::".$sp['contents']."::".$sp['time']."///<br>";
		}
}else if($user2 != ""){//user2에 입력값이 있을경우 게시글 검색으로 간주하고 검색어가 포함된 이름과 내용을 검색한다.
$friendquery = "select distinct user2 from friends where user1='".$user1."'or user2Nickname like '%".$user2."%' union select '".$user1."'";
$friend = mysqli_query($conn, $friendquery);
foreach($friend as $f)
{
	$friendquery = "select user2 from friends where user1='".$user1."' and user2Nickname ='%".$user2."%'";
	$friend = mysqli_query($conn, $friendquery);
	$searchpostquery = "select * from posting where id = '".$f['user2']."' and contents like '%".$user2."%' order by time asc";
	if($f['user2']== $user1)
	{
		$searchpostquery = "select * from posting where id = '".$f['user2']."' and contents like '%".$user2."%' or user like '%".$user2."%'order by time asc";
	}
	$searchpost = mysqli_query($conn, $searchpostquery);
	$checksum= mysqli_num_rows($searchpost);
	if($checksum){
		$check++;
		foreach($searchpost as $sp){
			echo $sp['uid']."::".$sp['id']."::".$sp['image']."::".$sp['postimage']."::".$sp['user']."::".$sp['contents']."::".$sp['time']."///<br>";
		}
	}
}
if($check == 0)
	{
		echo "일치하는 게시글이 없습니다.";
	}
}

?>