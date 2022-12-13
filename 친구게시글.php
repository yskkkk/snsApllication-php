<table class=post>
<td>
<?php
error_reporting(1);
$servername = 'localhost';
$username = 'root';
$password = 'tomtom';
$dbname = 'ysk';

$conn = new mysqli($servername, $username, $password, $dbname);

$user1= $_GET['id'];

$searchpostquery = "select * from posting where id = '".$user1."'order by uid desc";
$searchpost = mysqli_query($conn, $searchpostquery);
	foreach($searchpost as $sp)
		echo $sp['uid']."::".$sp['id']."::".$sp['image']."::".$sp['postimage']."::".$sp['user']."::".$sp['contents']."::".$sp['time']."///<br>";
		
$conn->close();
?>