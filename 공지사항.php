<table class=notice>

<?php 
$hostname = 'localhost';
$dbname = 'ysk';
$dbuser = 'root';
$dbpass = 'tomtom';

$mysqli = new mysqli($hostname, $dbuser, $dbpass, $dbname);

$posting = $mysqli->query('SELECT * FROM notice order by uid desc');
?>

	  <tr>
	 <?php foreach ($posting as $post){ ?>
	 <td> <?php echo $post['uid']; ?> </td>
	 <td> <?php echo $post['title']; ?> </td>
	 <td> <?php echo $post['contents']; ?> </td>
	 <td> <?php echo $post['time']; ?> </td>
	<body bgcolor='white'>
      </tr>
	<?php } ?>
