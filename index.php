<?php

require_once 'app/init.php';

//determine to see if values are set
if(isset($_GET['q'])){

	//store query in a variable
	$q=$_GET['q'];

//Use elasticsearch instance to search our employee index 
$params = array();
	//use the elasticsearch search method to search the index
$params['body']['query']['bool']['should'] = array(
    array('match' => array('name' => $q)),
    array('match' => array('date_of_hire' => $q)),
    array('match' => array('employee_number' => $q))
);

$results = $client->search($params);

	//echo '<pre>', print_r($results) , '</pre>';

//die();


if($results['hits']['total']>=1){

$retresults = $results['hits']['hits'];

echo '<div><p>We found ',$results['hits']['total'],' results</p></div>';

}
else{

	echo '<div><h2>No results Found for ','"',$q,'"','</h2></div>';
}

}

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Test ElasticSearch Engine</title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<h1>Test Search Engine using Elasticsearch</h1>
		<form action="index.php" method="get" autocomplete="off">
		<label>Search a Employee  
			<input type="text" name="q">
		</label>	
		
		<input type="submit" value="Search">
		</form><br /><br />
		<div class="results">
			<div class="total">

			

			</div>

<?php

if(isset($retresults)){
?>
<h1>Elastic Search Results</h1>
<table class="table table-hover" border="1" cell-padding="1">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Employee Number</th>
          <th>Date Hired</th>
        </tr>
      </thead>
      <tbody>
<?php
	foreach ($retresults as $key) {

			echo "<tr><td>", $key['_id'], "</td>";

			echo "<td>", $key['_source']['name'], "</td>";
					
				

			echo "<td>", $key['_source']['employee_number'], "</td>";
					
				

		echo "<td>", $key['_source']['date_of_hire'], "</td></tr>";
					
				
		
	}
}


?>	

			</div>

	</body>



</html>