<?php
error_reporting(1);
 $servername = "localhost";
$username = "root";
$password = "tomtom";
$dbname = "ysk";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("접속 오류: " . $conn->connect_error);
}
$id = $_GET['id'];
$mode = $_GET['mode'];
   $image = $_FILES["image"]["name"];
   $imagePath = "./profileimage/".$image;
   $tmp_name = $_FILES["image"]["tmp_name"];

if($mode==1){// 프로필
if (move_uploaded_file($tmp_name, $imagePath)){
	mysqli_query($conn,"update profile set image = 'www.teamtoktok.kro.kr/profileimage/".$image."' where id='".$id."'");
	mysqli_query($conn,"update posting set image = 'www.teamtoktok.kro.kr/profileimage/".$image."' where id='".$id."'");
	echo "1완료";
}
}
else if ($mode==2){ //게시글
if (move_uploaded_file($tmp_name, $imagePath)){
	$searchquery = "select * from posting where id= '".$id."' order by uid desc limit 0,1";
	$search = mysqli_query($conn,$searchquery);
	foreach($search as $s)
	mysqli_query($conn,"update posting set postimage = 'www.teamtoktok.kro.kr/profileimage/".$image."' where id='".$id."'and uid='".$s['uid']."'");
	echo "2완료";
}


}

$conn->close();
?>