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
			<h1>Kindly add in your details</h1>
		</div>
		<?php
		   $db = new PDO('sqlite:user.db');
		   if(!$db){
		      //echo $db->lastErrorMsg();
		   }

		  $sql = "
		      CREATE TABLE users(
		      name           TEXT    NOT NULL,
		      email          TEXT    NOT NULL);
		   ";

		   @$ret = $db->exec($sql);
		   if(!$ret){
		      //echo $db->lastErrorMsg();
		   }
		?>
		
		<div id="wrapper">
			<div class="nav">
				<ul>
					<li><a href="index.php" class="btn btn-success">Home</a></li>
					<li><a href="list.php" class="btn btn-warning">List</a></li>
				</ul>
			</div>
			<div class="form-wrapper">
				<?php
					if(isset($_POST['create'])){
						$name = $_POST['name'];
						$email = $_POST['email'];
						if($name !== '' && $email !== ''){
							//These line prevent XSS attacks
							$name = trim($name);
							$email = trim($email);
							
							$name = strip_tags($name);
							$email = strip_tags($email);

							
							//These two lines prvents sql injection by allowing the SQLITE library prepare the statement
							$query = $db->prepare('SELECT * FROM users WHERE name=:name');
							$query->bindValue(':name', $name);
							
							$query->execute() or die("Error in query");
							$result = $query->fetchAll();
							$rows = count ($result);
							
							if($rows <= 0){
								if(filter_var($email, FILTER_VALIDATE_EMAIL)){
								  	
								  	//These two lines prevents sql injection by allowing the SQLITE library prepare the statement
									$query = $db->prepare('SELECT * FROM users WHERE email=:email');
									$query->bindValue(':email', $email);
								  	
									$query->execute() or die("Error in query");
									$rows = $query->fetchAll();
									$rows = count($rows);
									
									if($rows <= 0){
										//These three lines prvents sql injection by allowing the SQLITE library prepare the statement
										$query = $db->prepare('INSERT INTO users (name,email) VALUES (:name, :email)');
										$query->bindValue(':name', $name);
										$query->bindValue(':email', $email);
										
		  						     	$ret = $query->execute();
									 	if(!$ret){
									  	    //echo $db->lastErrorMsg();
									 	} 
									 	else {
									   	   echo"<div class='success-message'>Record created!</div>";
									 	}
									}
									else{
										echo"<div class='error-message'>Email already exists!</div>";
									}
								}
								else{
									echo"<div class='error-message'>Invalid email!</div>";
								}
							}
							else{
								echo"<div class='error-message'>Name already exists!</div>";
							}
						}
						else{
							echo"<div class='error-message'>Fill in all fields!</div>";
						}
					}
				?>
				<form method="POST" class="form">
				<div class="form-group has success">
					Create account
				</div>
				<div class="form-group">
        			<label class="control-label" for="nameField">Name</label>
        			<input type="text" name="name" class="form-control" id="nameField" placeholder="Your Name" />
    			</div>
    			<div class="form-group">
        			<label for="emailField">Email</label>
        			<input type="email" name="email" class="form-control" id="emailField" placeholder="Your Email address" />
    			</div>
			
				<button type="submit" class="btn btn-primary" name="create">Submit</button>
				<button type="reset" class="btn btn-default" name="clear">Reset</button>
				
				</form>
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