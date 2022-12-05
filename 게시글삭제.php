<table class=deletepost>
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

$id= $_GET['id']; 
$postuid = $_GET['postuid'];

$deletepostquery = "delete from posting where uid = '".$postuid."' and id='".$id."'";
$deletecommentquery = "delete from comment where postuid = '".$postuid."'";

$searchprofile = "select * from posting where id='".$id."' and uid='".$postuid."'";
$search = mysqli_query($conn, $searchprofile);
$checksum = mysqli_num_rows($search);

$searchpost = "select * from posting where uid='".$postuid."'";
$search2 = mysqli_query($conn,$searchpost);
$checksum2 = mysqli_num_rows($search2);

if($checksum) // 게시글이 존재하는지 여부 확인
{
	if(($conn->query($deletepostquery)===TRUE)&&($conn->query($deletecommentquery)===TRUE))// 게시글 삭제, 관련 댓글삭제
		{
			echo "게시글이 삭제되었습니다.";
		}
}else
{
	if(!$checksum2)//존재하는 게시글인지 여부 확인
	{
		echo "존재하지 않는 게시글입니다.";
	}else{// 나의 게시글이 아닐경우
	echo "권한이 없는 게시글 입니다.";
	}
}


$conn->close();
?> 