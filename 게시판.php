<?php 
$hostname = 'localhost';
$dbname = 'ysk';
$dbuser = 'root';
$dbpass = 'tomtom';


// STEP TWO : connecting to the database
$mysqli = new mysqli($hostname, $dbuser, $dbpass, $dbname);

// STEP THREE : SQL query
$posting = $mysqli->query('SELECT * FROM posting order by num desc');

 ?>

<table> 
<thead>
	<tr>
	  <th>num</th>
	 <th>title</th>
         <th>user</th>
	 <th>contents</th>
         <th>time</th>
	 </tr>
</thead>

<tbody>
       <tr>
	 <?php foreach ($posting as $post){ ?>
	 <td> <?php echo $post['num']; ?> </td>
	 <td> <?php echo $post['title']; ?> </td>
	 <td> <?php echo $post['user']; ?> </td>
	 <td> <?php echo $post['contents']; ?> </td>
	 <td> <?php echo $post['time']; ?> </td>
	<body bgcolor='white'>
      </tr>
	<?php } ?>
</tbody>
</table>