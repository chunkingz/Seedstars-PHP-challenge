<?php
#script written by kingston fortune
#using sublime text

include_once('csrfFilter.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home</title>
		<link href="css/application.css" type="text/css" rel="stylesheet"/>
		<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet"/>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<!--[if lt IE 9]>
      	<script type="text/javascript" src="js/html5shiv.js"></script>
      	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
	</head>
	<body>
	<div class="container">
		<div class="page-header">
			<h1>List of Registered users</h1>
		</div>
		<?php
	   	   class MyDB extends SQLite3{
		      function __construct(){
		         $this->open('user.db');
		      }
		   }
		   
		   $db = new MyDB();
		   if(!$db){
		      //echo $db->lastErrorMsg();
		   }
	   
		   $sql = "SELECT * from users";
		   
	   ?>
	
	
		<div id="wrapper">
			<div class="nav">
				<ul>
					<li><a href="index.php" class="btn btn-success">Home</a></li>
					<li><a href="add.php" class="btn btn-danger">Create</a></li>
				</ul>
			</div>
			<div class="form-wrapper">
				<?php
					$ret = $db->query($sql);
				   	echo "<table class='table table-striped table-hover' border='1' style='text-align=center; margin: 0 auto;' cellpadding='10'>";
				   	echo "<tr>";
				   	echo "<td><strong>Name</strong></td>";
				   	echo "<td><strong>Email</strong></td>";
				   	echo "</tr>";
				   	while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
				      	echo "<tr>
				      			<td>". htmlspecialchars($row['name']) ."</td>
				      			<td>". htmlspecialchars($row['email'])."</td>
				      		</tr>";
				   	}
			   	   	echo "</table>";
           		   	$db->close();
				?>
			</div>
		</div>
		<div class="page-footer">
			<h6>Seedstars php challenge <?php echo date('Y'); ?></h6>
		</div>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	</body>
</html>