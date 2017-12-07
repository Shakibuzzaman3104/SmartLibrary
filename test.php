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

	$locker=mysqli_query($conn,"SELECT * FROM locker");
	$lockquery=mysqli_fetch_array($locker);

?>

<!DOCTYPE html>


<html>

	 <head>
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<title>Welcome - <?php echo $userRow['St_id']; ?></title>
	<style>

</style>
	</head>

	<body>
		<div class="container"> 									<!--start of main container -->
			<div class="Header">
				<div class="Header_right">
					<div class="dropdown">
  					<button class="dropbtn">My Account</button>
  						<div class="dropdown-content">
    					<a href="logout.php?logout">&nbsp;Log Out</a>
  						</div>
							</div>
				</div>
			</div>
				<div class="nav">                                       <!-- Start of navition -->
				<a href="home.php"><input class="button button3" type="button" value="Home"></a>
				<a href="my_locker.php"><input class="button button3" type="button" value="My Locker"></a>
			</div>
		  <div class="container_body"> 							    <!--Start of container for body-->
						
				<div class="uppers" align="center">
					<div class="frst">
					
					<div><h3>Customer Details</h3></div>
						<table>
  <tr>
    <th>Customer Number</th>
    <th>Customer Name</th>
    <th>Customer Address</th>
	<th>Product ID</th>
    <th>Product Quantity</th>
	<th>Total Bill</th>
    <th>Employye ID</th>
  </tr>
  <tr>
    <td>5764674</td>
    <td>Griffin</td>
    <td>xyz</td>
	<td>001</td>
	<td>2</td>
	<td>$333</td>
	<td>E1</td>
  </tr>
  </table>
					</div>
				</div>
		   </div> 			
		 <div class="Footer"></div>
		

		<!--End of main container-->
</div>
	</body>
</html>
