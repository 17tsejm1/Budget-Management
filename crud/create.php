<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$departmentError = null;
		$nameError = null;
		$amountError = null;
		$reasonError = null;
	
	
		// keep track post values
		$department = $_POST['department'];
		$name = $_POST['name'];
		$amount = $_POST['amount'];
		$reason = $_POST['reason'];
		$status = pending['status'];
	
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($amount)) {
			$amountError = 'Please enter amount of funding required';
			$valid = false;
		}
		
		if (empty($reason)) {
			$reasonError = 'Please enter reason for funding';
			$valid = false;
		}
		
		if (empty($department)) {
			$departmentError = 'Please enter the department you are in';
			$valid = false;
		}
		
	
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO requests (name,amount,reason,status,department) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$amount,$reason,$status,$department));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create a request</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($departmentError)?'error':'';?>">
					    <label class="control-label">Department</label>
					    <div class="controls">
					      	<input name="department" type="text" placeholder="Department" value="<?php echo !empty($department)?$department:'';?>">
					      	<?php if (!empty($departmentError)): ?>
					      		<span class="help-inline"><?php echo $departmentError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($reasonError)?'error':'';?>">
					    <label class="control-label">Reason</label>
					    <div class="controls">
					      	<input name="reason" type="text"  placeholder="Reason for funding" value="<?php echo !empty($reason)?$reason:'';?>">
					      	<?php if (!empty($reasonError)): ?>
					      		<span class="help-inline"><?php echo $reasonError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($amountError)?'error':'';?>">
					    <label class="control-label">Amount of funding</label>
					    <div class="controls">
					      	<input name="amount" type="text"  placeholder="Amount of funding" value="<?php echo !empty($amount)?$amount:'';?>">
					      	<?php if (!empty($amountError)): ?>
					      		<span class="help-inline"><?php echo $amountError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					 

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
