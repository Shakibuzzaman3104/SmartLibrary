	<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';

	// if session is not set this will redirect to login page
	if ( !isset( $_SESSION[ 'user' ] ) ) {
		header( "Location: index.php" );
		exit;
	}
	// select loggedin users detail
	$res = mysqli_query( $conn, "SELECT * FROM student WHERE St_id=" . $_SESSION[ 'user' ] );
	$userRow = mysqli_fetch_array( $res );

	$locker = mysqli_query( $conn, "SELECT * FROM locker" );
	$lockquery = mysqli_fetch_array( $locker );

	?>

<!DOCTYPE html>

<html>

<head>
	<?php $var=$_POST['book'];?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<title>Welcome -
		<?php echo $userRow['St_id'];?>
	</title>
	<style>
		.dropbtn {
			background-color: #4CAF50;
			color: white;
			padding: 16px;
			font-size: 16px;
			border: none;
			cursor: pointer;
		}
		
		.dropdown {
			position: relative;
			display: inline-block;
		}
		
		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}
		
		.dropdown-content a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
		}
		
		.dropdown-content a:hover {
			background-color: #f1f1f1
		}
		
		.dropdown:hover .dropdown-content {
			display: block;
		}
		
		.dropdown:hover .dropbtn {
			background-color: #3e8e41;
		}
	</style>
</head>

<body>
	<div class="container">
		<!--start of main container -->
		<div class="Header">
			<div class="Header_right">
				<div class="dropdown">
					<button class="dropbtn">My Account</button>
					<div class="dropdown-content">
						<a href="logout.php?logout">&nbsp;Log Out</a>
						<a href="#">Change Password</a>
					</div>
				</div>
			</div>
		</div>
		<div class="nav">
			<!-- Start of navition -->
			<a href="home.php"><input class="button button3"  type="button" value="Home"></a>
			<a href="my_locker.php"><input class="button button3"  type="button" value="My Locker"></a>
			<a href="booktable.php"><input class="button button3" type="button" value="Book Table"></a>
		</div>
		<div class="container_body" align="center">
			<!--Start of container for body-->
			<div class="upper">
				<!--Start of upper div-->
				<form class="form-check-inline" action="book.php" method="post">
					<label><b>Time</b></label>
					<select name="hour" id="hour">
						<option value="8">08</option>
						<option value="9">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
					</select>
					<label><b>:</b></label>
					<select name="min" id="min">
						<option value="00">00</option>
						<option value="05">05</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
						<option value="30">30</option>
						<option value="35">35</option>
						<option value="40">40</option>
						<option value="45">45</option>
						<option value="50">50</option>
						<option value="55">55</option>
						<option value="60">60</option>
					</select>
					<button type="submit" class="button button11" name="book" id="submit" value="<?php echo $var; ?>">Submit</button>
				</form>
			</div>
			<!--End of upper div-->
			<!--End of Lower div-->
		</div>
		<!--End of container for body-->
		<div class="Footer"></div>
	</div>
	<!--End of main container-->

</body>

</html>