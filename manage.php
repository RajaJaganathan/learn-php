<?php

require_once 'employee.php';

$emp = new Employee();
$isDeleted = false;

// echo var_dump($_POST);

if(isset($_POST['delete'])){
	$isDeleted = $emp->deleteEmployee();
	clearAllFields();	
}elseif(isset($_POST['create'])){
	$isInserted = $emp->addEmployee();
	clearAllFields();	
}elseif(isset($_POST['update'])){
	$isUpdated = $emp->updateEmployee();	
}elseif(isset($_POST['updateRequired'])){
	$row = $emp->fetchByEmployeeId($_POST['id']);
	fillForms($row);	
}else{
	//Get
	clearAllFields();
}

$results = $emp->fetchAllEmployee();

function fillForms($row){
	$_POST['id'] = $row['id'];
	$_POST['name'] = $row['name'];
	$_POST['email'] = $row['email'];
	$_POST['contact'] = $row['contact_number'];
	$_POST['position'] = $row['position'];
}

function clearAllFields(){
	$_POST['id'] = "";
	$_POST['name'] = "";
	$_POST['email'] = "";
	$_POST['contact'] = "";
	$_POST['position'] = "";	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP CRUD Example</title>
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
</head>
<body>
<div class="container">
<div class="row">
<h1>PHP CRUD Application</h1>
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
				<th>Action</th>
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
						<form action="<? echo $_SERVER['PHP_SELF']?>" method="POST" role="form" class="col-xs-3">							
							<input type="hidden" name="id" value="<?php echo $value['id']?>">
							<button type="submit" name="updateRequired" class="btn btn-primary">Update</button>
						</form>
						<form action="<? echo $_SERVER['PHP_SELF']?>" method="POST" role="form" class="col-xs-3">							
							<input type="hidden" name="id" value="<?php echo $value['id']?>">
							<button type="submit" name="new" class="btn btn-primary">New</button>
						</form>
						<form action="<? echo $_SERVER['PHP_SELF']?>" method="POST" role="form" class="col-xs-3">							
							<input type="hidden" name="id" value="<?php echo $value['id']?>">
							<button type="submit" name="delete" class="btn btn-danger">Delete</button>
						</form>						
						 </td>					
					</tr>
				<?php
}
?>
		</tbody>
	</table>

	<form action="<? echo $_SERVER['PHP_SELF']?>" method="POST" role="form" class="col-xs-6">
	<legend></legend>
	<div class="form-group">
		<label for="name">Name</label>
		<input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?= $_POST['name']?>">
	</div>
		<div class="form-group">
		<label for="email">email</label>
		<input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?= $_POST['email']?>">
	</div>
		<div class="form-group">
		<label for="contact">contact</label>
		<input type="text" class="form-control" id="contact" name="contact" placeholder="contact" value="<?= $_POST['contact']?>">
	</div>
		<div class="form-group">
		<label for="position">Position</label>
		<input type="text" class="form-control" id="position" name="position" placeholder="position" value="<?= $_POST['position']?>">
		<input type="hidden" class="form-control" id="id" name="id" placeholder="id" value="<?= $_POST['id']?>">
	</div>
	<button type="submit" name="<?php echo isset($_POST['updateRequired']) || isset($_POST['update'])? "update": "create"?>" class="btn btn-primary">
	<?php echo isset($_POST['updateRequired']) || isset($_POST['update'])? "Update": "Add New"?>
	</button>
	<button type="reset" name="reset" class="btn btn-secondary">Reset</button>
</form>
</div>
</div>
</div>
</body>
</html>