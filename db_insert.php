<?php
require 'database/db.php';

$error = null;

if(isset($_POST['submit'])){
	
	$fields = array('name','email','contact','position');
	
	$success = validateForm();	
	
	if(!$success){
		$error = "Please fill out all fields";
		exit();
	}
	
	try{
		insert();
		$error = "Created successfully";
		$_POST['name'] = '';
		$_POST['email'] = '';
		$_POST['contact'] = '';
		$_POST['position'] = '';
	}
	catch(Exception $e){
		$success = false;
		$error = "Database error ".$e->getMessage();
	}
}

function validateForm(){
	foreach ($fields as $value) {
		$v = $_POST[$value];
		if(!isset($v) || empty($v)){
			return false;
		}
	}
	return true;
}

function insert(){
	$db = DBCxn::get();
	
	try{
		$st = $db->prepare("INSERT INTO employees(name,email,contact_number,position) VALUES (:name, :email, :contact_number, :position)");
		$st->bindParam(":name",$_POST['name']);
		$st->bindParam(":email",$_POST['email']);
		$st->bindParam(":contact_number",$_POST['contact']);
		$st->bindParam(":position",$_POST['position']);
		return $st->execute();
	}
	catch(PDOException $e){
		$success = false;
		throw $e;
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Database Form Insert App</title>
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
</head>
<body>
<div class="container">
	<div class="alert <?php echo ($success ? 'alert-success':'alert-danger') ?> row col-xs-7" role="alert">
		<?php echo $error ?>
	</div>
	<form action="<? echo $_SERVER['PHP_SELF']?>" method="POST" role="form" class="col-xs-6">
	<legend>PHP CRUD</legend>
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $_POST['name']?>">
	</div>
		<div class="form-group">
		<label for="email">email</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="name" value="<?= $_POST['email']?>">
	</div>
		<div class="form-group">
		<label for="contact">contact</label>
		<input type="text" class="form-control" id="contact" name="contact" placeholder="name" value="<?= $_POST['contact']?>">
	</div>
		<div class="form-group">
		<label for="position">Position</label>
		<input type="text" class="form-control" id="position" name="position" placeholder="name" value="<?= $_POST['position']?>">
	</div>
	<button type="submit" name="create" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>
