<table class=registerinfo>
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
$id = $_GET['id'];
$phone =$_GET['phone'];

$sql = "INSERT INTO profile(id, password, name, Nickname, message, phone, day, birthday) VALUES('".$_GET['id']."', '".$_GET['password']."', '".$_GET['name']."', '".$_GET['name']."', '','".$_GET['phone']."', sysdate(), '".$_GET['birthday']."')";
$sql2="select id,phone from profile";

if(($_GET['id']=="")){
echo "id값이 비어있습니다.<br>";
}
else if(($_GET['password']=="")){
echo "password값이 비어있습니다.<br>";
}
else if(($_GET['name']=="")){
echo "name값이 비어있습니다.<br>";
}
else if(($_GET['phone']=="")){
echo "phone값이 비어있습니다.<br>";
}
else if(($_GET['birthday']=="")){ // Line 30
echo "birthday값이 비어있습니다.<br>";
}
else{
	$result = mysqli_query($conn,$sql2);
		while($row = mysqli_fetch_array($result)){
			if(($id == $row['id'])||($phone ==$row['phone'])){
				if($id == $row['id']){
					$checksum++;
					echo "id가 이미 존재합니다.";
					break;
				}// if
				else if($phone =$row['phone'])
					{
						$checksum++;
						echo "phone이 이미 존재합니다.";
						break;
					}
				}// if
			}// while
			 if($checksum == 0) {
				if($conn->query($sql) === TRUE) {
  					echo $id."님 회원가입에 성공했습니다.<br>";
				}// if 
			
		}//if
}

$conn->close();
//    ex) www.teamtoktok.kro.kr/회원가입.php?id=&password=&name=&message=&image=&phone=&birthday=
// ex) insert into profile(id,password, name,message, phone,day,birthday,Nickname) values('root','root', 'root','관리자','1234',sysdate(),'000111','root');
?>
