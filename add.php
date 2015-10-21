<?php

require_once 'app/init.php';

//If form action is not empty then look to see if values have been set
if(!empty($_POST)){
	//check to see if these values have been set
	if(isset($_POST['name'], $_POST['emp'], $_POST['dh'])) {
//if values are set store them in variables to index into elasticsearch
		$name = $_POST['name'];
		$emp = $_POST['emp'];
		$dh = $_POST['dh'];

		//start elasticsearch php-client

		$index = $client->index([
			'index'=> "employee",
			'type'=> "user",
			'body'=>[
				'name'=> $name,
				'employee_number'=> $emp,
				'date_of_hire' => $dh
				]
			]);
		if($index){

			echo 'submitted';
		}
		else{
			echo "Failed";
		}
	}
}

?>


<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Test Indexing/Searching</title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<h1>Testing Real time indexing with Elasticsearch</h1>
		<form action="add.php" method="post" autocomplete="off">
			<label>Name of Employee
				<input type="text" name="name">
			</label>

			<label>Employee #
				<input type="text" name="emp">
			</label>
		
			<label>Date hired
				<input type="text" name="dh">
			</label>

			<input type="submit" name="Add">
		</form>


	</body>



</html>