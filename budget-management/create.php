<?php 
	
	require 'database.php';
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$departmentError = null;
		$teacherError = null;
		$emailError = null;
		$amountError = null;
		$statusError = null;
		$reasonError = null;
		
		// keep track post values
		$department = $_POST['department'];
		$teacher = $_POST['teacher'];
		$email = $_POST['email'];
		$amount = $_POST['amount'];
		$status = $_POST['status'];
		$reason = $_POST['reason'];
		
		// validate input

		if (empty($department)) {
			$departmentError = 'Please enter Department Name';
			$valid = false;
		}

		$valid = true;
		if (empty($teacher)) {
			$teacherError = 'Please enter teacher';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Please enter Email Address';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}

		if (empty($amount)) {
			$amountError = 'Please enter a valid amount (cannot be more then 6 digits)';
			$valid = false;
		}

		if (empty($reason)) {
			$reasonError = 'Please enter a valid reason';
			$valid = false;
		}

		if (empty($status)) {
			$statusError = 'Please enter a valid status';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO customers (department,teacher,email,amount,reason,status) values(?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($department,$teacher,$email,$amount,$reason,$status));
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
		    			<h3>Create a Customer</h3>
		    		</div>

		    	
	    			<form class="form-horizontal" action="create.php" method="post">

	    			  	<div class="control-group <?php echo !empty($departmentError)?'error':'';?>">
					    <label class="control-label">Department</label>
					    <div class="controls">
					      	<select name="department">
					      	  <option value="#">Select...</option>
							  <option value="Arts and Physical Education">Arts and Physical Education</option>
							  <option value="English">English</option>
							  <option value="Humanities">Humanities</option>
							  <option value="Languages">Languages</option>
							  <option value="Mathematics">Mathematics</option>
							  <option value="Science">Science</option>
							  <option value="Technology and ICT">Technology and ICT</option>
							  <option value="General Administration">General Administration</option>
							  <option value="Finance Administration">Finance Administration</option>
							  <option value="Resources Administration">Resources Administration</option>
							  <option value="Senior School Office">Senior School Office</option>
							  <option value="Middle School Office">Middle School Office</option>
							  <option value="Lower School Office">Lower School Office</option>
							  <option value="Examinations and Higher Education">Examinations and Higher Education</option>
							  <option value="Library and Learning Centre">Library and Learning Centre</option>
							  <option value="Medical Support">Medical Support</option>
							  <option value="IT Support">IT Support</option>
							  <option value="Science Support">Science Support</option>
							  <option value="Design and Technology Support">Design and Technology Support</option>
							  <option value="Food Technology Support">Food Technology Support</option>
							  <option value="Art Support">Art Support</option>
							  <option value="PE Support">PE Support</option>
							  <option value="Educational Support">Educational Support</option>
							  <option value="Facilities">Facilities</option>					  
							  <option value="Life Guards">Life guards</option>
							  <option value="Cleaning Team">Cleaning Team</option>
							  <option value="ISS Facilities Services">ISS Facilities Services</option>
							  <option value="Security Services">Security Services</option>
							  <option value="Non-School Hour Services">Non-School Hour Services</option>
							</select>  
					      	<?php if (!empty($departmentError)): ?>
					      		<span class="help-inline"><?php echo $departmentError;?></span>
					      	<?php endif;?>
					    </div>
    				  </div>
					  <div class="control-group <?php echo !empty($teacherError)?'error':'';?>">
					    <label class="control-label">Teacher</label>
					    <div class="controls">
					    	<select name="teacher">
					    	  <option value="#">Select...</option>
							  <option value="Mr.Farrow">Mr.Farrow</option>
							  <option value="Mr.Nickey">Mr.Nickey</option>
							  <option value="Mr.Karan">Mr.Karan</option>
							</select>
					      	<?php if (!empty($teacherError)): ?>
					      		<span class="help-inline"><?php echo $teacherError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  
					    <!-- amount -->
					    <div class="control-group <?php echo !empty($amountError)?'error':'';?>">
						    <label class="control-label">Amount Requested</label>
						    <div class="controls">
						      	<input name="amount" type="text" placeholder="Amount requested" value="<?php echo !empty($amount)?$amount:'';?>">
						      	<?php if (!empty($amountError)): ?>
						      		<span class="help-inline"><?php echo $amountError;?></span>
						      	<?php endif;?>
						    </div>
					    </div>
					    <!-- reason -->

					    <div class="control-group <?php echo !empty($reasonError)?'error':'';?>">
						    <label class="control-label">Reason for budget request</label>
						    <div class="controls">
						      	<textarea name="reason" placeholder="Reason for Budget Request" rows="5" cols="80" value="<?php echo !empty($reason)?$reason:'';?>"></textarea>
						      	<?php if (!empty($reasonError)): ?>
						      		<span class="help-inline"><?php echo $reasonError;?></span>
						      	<?php endif;?>
						    </div>
						</div>
					  
					  <!-- status -->
					  <div class="control-group <?php echo !empty($statusError)?'error':'';?>">
					    <div class="controls">
					      	<input name="status" type="hidden" value="Requested" >
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