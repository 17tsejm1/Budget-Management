<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$teacherError = null;
		$emailError = null;
		$departmentError = null;
		$amountError = null;	
		$reasonError = null;
		$statusError = null;
		
		// keep track post values
		$teacher = $_POST['teacher'];
		$email = $_POST['email'];
		$department = $_POST['department'];
		$amount = $_POST['amount'];
		$reason = $_POST['reason'];
		$status = $_POST['status'];
		
		// validate input
		$valid = true;

		if (empty($status)) {
			$statusError = 'Please enter a valid Status';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE customers  set status =? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($status,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM customers where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$teacher = $data['teacher'];
		$email = $data['email'];
		$department = $data['department'];
		$amount = $data['amount'];
		$reason = $data['reason'];
		$status = $data['status'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>

    <SCRIPT language="JavaScript">

	var password;

	var pass1="letmein";

	password=prompt('Please enter your password to view this page!',' ');

	if (password==pass1)
	  alert('Password Correct! Click OK to enter!');
	else
	   {
	    window.location="index.php";
	    }

	</SCRIPT>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update a budget request</h3>
		    		</div>
    		

	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">

	    				   <div class="control-group <?php echo !empty($departmentError)?'error':'';?>">
						    <label class="control-label">Department Name</label>
						     <div class="controls">
						      	<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($teacher)?$teacher:'';?>" disabled>
						      	<?php if (!empty($teacherError)): ?>
						      		<span class="help-inline"><?php echo $teacherError;?></span>
						      	<?php endif; ?>
						    </div>
						    <label class="control-label">Teacher</label>

						  <div class="control-group <?php echo !empty($teacherError)?'error':'';?>">
						    <label class="control-label">Teacher</label>
						    <div class="controls">
						      	<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($teacher)?$teacher:'';?>" disabled>
						      	<?php if (!empty($teacherError)): ?>
						      		<span class="help-inline"><?php echo $teacherError;?></span>
						      	<?php endif; ?>
						    </div>
						  </div>

						  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
						    <label class="control-label">Email Address</label>
						    <div class="controls">
						      	<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>" disabled>
						      	<?php if (!empty($emailError)): ?>
						      		<span class="help-inline"><?php echo $emailError;?></span>
						      	<?php endif;?>
						    </div>
						  </div>

						 

					    <div class="control-group <?php echo !empty($amountError)?'error':'';?>">
						    <label class="control-label">Amount Requested</label>
						    <div class="controls">
						      	<input name="amount" type="text" placeholder="Amount" value="<?php echo !empty($amount)?$amount:'';?>" disabled>
						      	<?php if (!empty($amountError)): ?>
						      		<span class="help-inline"><?php echo $amountError;?></span>
						      	<?php endif;?>
						    </div>
					    </div>


					    <div class="control-group <?php echo !empty($reasonError)?'error':'';?>">
						    <label class="control-label">Reason</label>
						    <div class="controls">
						      	<textarea name="reason" placeholder="Address" rows="5" cols="80" value="<?php echo !empty($reason)?$reason:'';?>" disabled></textarea>
						      	<?php if (!empty($reasonError)): ?>
						      		<span class="help-inline"><?php echo $reasonError;?></span>
						      	<?php endif;?>
						    </div>
						</div>

					    <div class="control-group <?php echo !empty($statusError)?'error':'';?>">
						    <label class="control-label">Status</label>
						    <div class="controls">
						      	<select name="status">
						      	  <option value="#">Select...</option>
								  <option value="Approved">Approved</option>
								  <option value="Pending">Pending</option>
								  <option value="Rejected">Rejected</option>
								</select>  
						      	<?php if (!empty($amountError)): ?>
						      		<span class="help-inline"><?php echo $amountError;?></span>
						      	<?php endif;?>
						    </div>
					    </div>

						  <div class="form-actions">
							  <button type="submit" class="btn btn-success">Update</button>
							  
							  <a class="btn" href="index.php">Back</a>
						  </div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>