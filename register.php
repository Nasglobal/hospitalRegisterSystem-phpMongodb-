
<?php
require_once('dbconnect.php');
session_start();
if(!isset($_SESSION['user'])){
  header("location:index.php");
}

					 if(isset($_POST["username"]) && isset($_POST["password"])){
					 $username = trim(strtolower($_POST['username']));
	                 $password = hash('sha256',trim(strtolower($_POST['password'])));
					if(empty($username) || empty($password)){
	 $GLOBALS['msg']="<div class='alert alert-danger'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>Sorry Empty Field Not Allowed</strong>
</div>";
	}else{
	 $patientdb->user->insertOne(
	['username' => $username, 'password' => $password]
	);

	 $GLOBALS['msg'] = "<div class='alert alert-success'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  <strong>User Created successfully</strong>
</div>";
	}
	 }
					 ?>
					






<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Online Hospital Management System</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
		 <script src="js/jquery.js"></script>
		
    </head>
    <body>
	
	<div class="container-fluid">
		<!--- Header --------------------------->
		<div class="row navbar-fixed-top">
			<nav class="navbar navbar-default header">
			<div class="container-fluid">
				<div class="navbar-header">
				  <a class="navbar-brand logo" href="#">
					<img alt="Brand" src="images/logo.png">
				  </a>
				  <div class="navbar-text title"><p>Hospital Payment System<p></div>
				</div>
			</div>
			</nav>
		</div>
		<!--- Header Ends Here --------------------------->
		
		<div class="row ">
		
			<div class="col-md-12">
			<br/>
				<div class="panel panel-default login">
					<div class="panel-heading logintitle">Create New User
					
					</div>
					
					<div class="panel-body">
					<?php
		if(isset($GLOBALS['msg'])){
			$message = $GLOBALS['msg'];
			echo $message;
		}
		?>
                                            <form class="form-horizontal center-block" role="form" action="register.php" method="post">
							
								<div class="input-group input-group-lg">
								  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
								 <input name="username" class="form-control" placeholder="Enter Username"   aria-describedby="sizing-addon1">
								</div>
								<br/>
                                  <div>
                                                                    
                                  </div>
								
								
								<br/>
								<div class="input-group input-group-lg">
								  <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
								  <input type="text" name="password" class="form-control" placeholder="Enter Password"  aria-describedby="sizing-addon1">
								</div>
								<br/>
								<div class="col-sm-7 col-sm-offset-2">
								
								  <button type="submit" class="btn btn-primary btn-block btn-lg">Create User</button>
								 
								</div>
								<a href="admin.php">Back</a>
						</form>
					</div>
						
				</div>
			</div>				
		</div>
		
		
		<div class="row footer navbar-fixed-bottom">
			<div class="col-md-12">
				<p>Copyrights @ Hospital Payment System 2019. All rights reserved. </p>
			</div>
		</div>
		
		
		
	
		<!--- Footer ---------------------------
		<div class="row marginreset">
			<div class="col-md-12 footer" >
				<p class="developer">Designed and Developed By Chinonso Chime</p>
				<p>Copyrights © Hospital Payment System 2017. All rights reserved. </p>
				
			</div>
			
		</div>
		
		<!--- Footer Ends Here --------------------------->
	</div>
		 
    <script src="js/bootstrap.min.js"></script>

    </body>
</html>