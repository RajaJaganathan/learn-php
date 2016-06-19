<?php

require_once 'database/db.php';

$db = DBCxn::get();

echo "<h3>PDO fetchAll FETCH_BOTH</h3>";
$st = $db->query('SELECT * FROM employees');
$results = $st->fetchAll(PDO::FETCH_BOTH);
foreach ($results as $key => $value){
	print_r($value);
	echo "<br>";
}

echo "<h3>PDO fetchAll FETCH_ASSOC</h3>";
$st = $db->query('SELECT * FROM employees');
$results = $st->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $key => $value){
	print_r($value);
	echo "<br>";
}

echo "<h3>Resultset Count</h3>";

echo "Count is :: ".count($results)." <br>rowCount() :: ".$st->rowCount();

echo "<h3>PDO While fetch</h3>";

$st = $db->query('SELECT * FROM employees');

while($row = $st->fetch(PDO::FETCH_ASSOC)){
	print_r($row);
}

//Note nothing prints

echo "<h3>JSON Result</h3>";

$st = $db->query('SELECT * FROM employees');
$results = $st->fetchAll(PDO::FETCH_ASSOC);
// $json = json_encode($result);
$json = json_encode(array("data"=>$results));

echo $json;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PDO Select </title>
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
</head>
<body>
<div class="container">
<div class="row">
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Contact</th>
				<th>Position</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($results as $key => $value) {
	?>
				<tr>
						<td><?php echo $value['name'] ?> </td>					
						<td><?php echo $value['email'] ?> </td>					
						<td><?php echo $value['contact_number'] ?> </td>					
						<td><?php echo $value['position'] ?></td>
					</tr>
				<?php
}
?>
		</tbody>
	</table>
</div>
</div>
</div>
</body>
</html>