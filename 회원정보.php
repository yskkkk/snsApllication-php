<?php 
$hostname = 'localhost';
$dbname = 'ysk';
$dbuser = 'root';
$dbpass = 'tomtom';


// STEP TWO : connecting to the database
$mysqli = new mysqli($hostname, $dbuser, $dbpass, $dbname);

// STEP THREE : SQL query
$posting = $mysqli->query('SELECT * FROM profile');

 ?>

<table class = "userinfo"> 
<thead>
<!--	<tr>
         <th>uid</th>
         <th>id</th>
         <th>password</th>
         <th>name</th>
         <th>message</th>
         <th>image</th>
         <th>phone</th>
         <th>day</th>
         <th>birthday</th>
         <th>Nickname</th>
</tr>
-->

</thead>

<tbody>
       <tr>
	 <?php foreach ($posting as $post){ ?>
	 <td> <?php echo $post['uid']; ?> </td>
	 <td> <?php echo $post['id']; ?> </td>
	 <td> <?php echo $post['password']; ?> </td>
	 <td> <?php echo $post['name']; ?> </td>
	 <td> <?php echo $post['message']; ?> </td>
	 <td> <?php echo $post['image']; ?> </td>
	 <td> <?php echo $post['phone']; ?> </td>
	 <td> <?php echo $post['day']; ?> </td>
	 <td> <?php echo $post['birthday']; ?> </td>
	 <td> <?php echo $post['Nickname']; ?> </td>
	<body bgcolor='white'>
      </tr>
	<?php } ?>
</tbody>
</table>