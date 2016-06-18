<?php

require 'database/db.php';

$db = DBCxn::get();
$st = $db->query('SELECT * FROM employees');
$results = $st->fetchAll(PDO::FETCH_ASSOC);
$isDeleted = false;

if(isset($_POST['delete'])){
	$dst = $db->prepare("DELETE FROM employees WHERE id=:id");
	$dst->bindParam(":id",$_POST['id']);
	$isDeleted = $dst->execute();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PDO Select</title>
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
</head>
<body>
<div class="container">
<div class="row">
<?php if($isDeleted){ ?>
<div class="alert alert-success">
	Deleted sucessfully
</div>
<?php } ?>
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
						<td><?php echo $value['position'] ?> </td>					
						<td> 
						<form action="<? echo $_SERVER['PHP_SELF']?>" method="POST" role="form">							
							<input type="hidden" name="id" value="<?php echo $value['id']?>">
							<button type="submit" name="delete" class="btn btn-primary">Delete</button>
						</form>
						 </td>					
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