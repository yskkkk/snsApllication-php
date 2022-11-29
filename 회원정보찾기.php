<table class = "profileinfo">
<td>
<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "tomtom";
$dbname = "ysk";
$conn = new mysqli($servername, $username, $password, $dbname);

$id= $_GET['id'];
$phone = $_GET['phone']; 
$birthday= $_GET['birthday'];

$findid = "select id from profile where phone='".$phone."'and birthday='".$birthday."'"; // 아이디를 찾으려면 phone, birthday
$findpassword ="select password from profile where id='".$id."' and phone='".$phone."'and birthday='".$birthday."'"; //비밀번호를 찾으려면 id phone birthday

$searchid = mysqli_query($conn,$findid);
$checkid = mysqli_num_rows($searchid); //아이디의 존재 여부 확인

$searchpassword = mysqli_query($conn,$findpassword);
$checkpassword = mysqli_num_rows($searchpassword); //password의 존재 여부 확인

if ($checkid and $id=="") {
	foreach($searchid as $sid);
		{	echo "아이디 찾기에 성공했습니다.::";
			echo$sid['id'];
		}
  
}
else if(!$checkid)
{
	echo"일치하는 정보가 없습니다.";
}

if ($checkpassword && $id !="") {
	foreach($searchpassword as $spw);
		{	echo "비밀번호 찾기에 성공했습니다.::";
			echo $spw['password'];
		}
  
}else if(!$checkpassword && $checkid && $id != "")
{
	echo"일치하는 정보가 없습니다.";
}
$conn->close();
?>
