<table class=notice>
<td>
<?php 
$hostname = 'localhost';
$dbname = 'ysk';
$dbuser = 'root';
$dbpass = 'tomtom';

$mysqli = new mysqli($hostname, $dbuser, $dbpass, $dbname);

$posting = $mysqli->query('SELECT * FROM notice order by uid desc'); 
 foreach ($posting as $post){
	echo $post['uid']."::".$post['title']."::".$post['contents']."::".$post['time']."///"; //모든 공지사항 출력
}
	
 ?>