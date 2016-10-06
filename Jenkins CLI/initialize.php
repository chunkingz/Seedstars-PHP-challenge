<?php
# script by kingston fortune
# using sublime text

	require __DIR__ . '/vendor/autoload.php';
	
	date_default_timezone_set('Africa/Lagos');
	
	$db = new PDO('sqlite:job.db');
	
	if(!$db){
	    //echo $db->lastErrorMsg();
	}
	$sql = "
		CREATE TABLE jobs(
	    number           int    NOT NULL,
	    status          TEXT    NOT NULL,
	    time_checked    TEXT    NOT NULL);
	";

	$ret = $db->exec($sql);
	
    $jenkins = new \JenkinsKhan\Jenkins('http://user:pass@localhost:81');
	$job = $jenkins->getJob('Helloworld');
    foreach ($job->getBuilds() as $build) {
     	//var_dump($build->getNumber());
     	//echo $build->getNumber();
      	//var_dump($build->getResult());
      
   		$number = $build->getNumber();
	    $status = $build->getResult();
	    $time_checked = date('Y-m-d  h:i:sa');
	      
	    $query = $db->prepare('INSERT INTO jobs (number,status,time_checked) VALUES (:number, :status, :time_checked)');
		$query->bindValue(':number', $number);
		$query->bindValue(':status', $status);
		$query->bindValue(':time_checked', $time_checked);
		
	 	$ret = $query->execute();
      
    }
	echo "Job stored!";
?>