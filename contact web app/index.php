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
	<h1>Welcome to the php web challenge!<small> feel free to explore...</small></h1>
	</div>

		<div id="wrapper">
			<div class="nav">
				<ul>
					<li><a href="list.php" class="btn btn-lg btn-info">List</a></li>&nbsp;&nbsp;&nbsp;
					<li><a href="add.php" class="btn btn-lg btn-success">Create</a></li>
				</ul>
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