	<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$res=mysqli_query($conn,"SELECT * FROM student WHERE St_id=".$_SESSION['user']);
	$userRow=mysqli_fetch_array($res);
?>

<!DOCTYPE html>


<html>

	<title>

	</title>

	 <head>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	</head>

	<body>
		<div class="container"> 									<!--start of main container -->
			<div class="Header">
				<div class="Header_right">
					<a href="logout.php?logout"><input class="button" type="button" value="Logout"></a>
				</div>
			</div>
				<div class="nav">                                       <!-- Start of navition -->
				<a href="My_Locker.php?logout"><input class="button button3" type="button" value="My Locker"></a>
			</div>
		  <div class="container_body"> 							    <!--Start of container for body-->
			<div class="upper"> 							        <!--Start of upper div-->
				<div class="upper_left">
				<img src="unlocked.png" height="300px" width="280px">
				    <div class="button_space">
							
						<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" >
					<input class="button button1" type="button" value="Occupy">
					</form>

					</div>
				</div>
				<div class="upper_leftn">
				<img src="unlocked.png" height="300px" width="280px">
				<div class="button_space">
					<input class="button button1" type="button" value="Occupy">

					</div>
				</div>
				<div class="upper_center">
				<img src="unlocked.png" height="300px" width="280px">
				<div class="button_space">
					<input class="button button1" type="button" value="Occupy">

					</div>
				</div>
				<div class="upper_right">
				<img src="unlocked.png" height="300px" width="280px">
				<div class="button_space">
					<input class="button button1" type="button" value="Occupy">

					</div>
				</div>
			</div>  								                  <!--End of upper div-->
			<div class="Lower"> 				                      <!--Start of Lower div-->
			<div class="upper_left">
				<img src="locked.png" height="300px" width="280px">
				    <div class="button_space">
					<input class="button button1" type="button" value="Occupy1">
					</div>
				</div>
				<div class="upper_leftn">
				<img src="locked.png" height="300px" width="280px">
				<div class="button_space">
					<input class="button button1" type="button" value="Occupy">

					</div>
				</div>
				<div class="upper_center">
				<img src="locked.png" height="300px" width="280px">
				<div class="button_space">
					<input class="button button1" type="button" value="Occupy">

					</div>
				</div>
				<div class="upper_right">
				<img src="locked.png" height="300px" width="280px">
				<div class="button_space">
					<input class="button button1" type="button" value="Occupy">

					</div>
				</div>
			</div> 							                   <!--End of Lower div-->
		  </div> 											   <!--End of container for body-->
		 <div class="Footer"></div>
		</div> 								                   <!--End of main container-->

	</body>
</html>
