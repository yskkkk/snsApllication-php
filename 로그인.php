<table class = "logininfo"> 
<td>
<?php 
$hostname = 'localhost';
$dbname = 'ysk';
$dbuser = 'root';
$dbpass = 'tomtom';

$conn = new mysqli($hostname, $dbuser, $dbpass, $dbname);

$sql="SELECT * FROM profile where id ='".$_GET['id']."' and password = '".$_GET['password']."'";

if(empty($_GET['id'])||empty($_GET['password']))
{	
	echo "값을 모두 입력해주세요.";
}
else
{	
	$result = mysqli_query($conn,$sql);
	$num = mysqli_num_rows($result);
	if($num==0)
	{
		echo "일치하는 로그인 정보가 없습니다.";
	}else{
	foreach ($result as $post){
	echo $post['uid']."::"; 
	echo $post['id']."::";
	echo $post['password']."::";
	echo $post['name']."::";
	echo $post['message']."::";
	echo $post['image']."::" ;
	echo $post['phone']."::"; 
	echo $post['day']."::"; 
	echo $post['birthday']."::";
	echo $post['Nickname']."<br>";
	}// foreach
 }	

}
 ?>
</td>
</table>
</class>