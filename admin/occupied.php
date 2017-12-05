<?php
ob_start();
session_start();
require_once '../dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
	header("Location: index.php");
	exit;
}
// select loggedin users detail
$res=mysqli_query($conn,"SELECT * FROM admin WHERE admin_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
?>
<!DOCTYPE html>

<html>




	 <head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="bootstrap.min.css">
	  <link rel="stylesheet" type="text/css" href="styles.css"/>
	<title>Welcome - <?php echo $userRow['admin_id']; ?></title>
	</head>

	<body>
		<div class="container"> 									<!--start of main container -->
			<div class="Header">
				<div class="Header_right">
					<a href="../logout.php?logout"><input class="button" type="button" value="Logout"></a>
				</div>
			</div>
			<div class="nav">                                       <!-- Start of navition -->
				<a href="index.php" ><input class="button button3" type="button" value="Home"></a>
				<a href="occupied.php" ><input class="button button10" type="button" value="Locker State" disabled></a>
				<a href="population.php" ><input class="button button3" type="button" value="Population"></a>
				<a href="booking_table.php" ><input class="button button3" type="button" value="Booking Table"></a>
			</div>
		  <div class="container_body"> 							    <!--Start of container for body-->
			<div class="upper" align="center"> 							        <!--Start of upper div-->
				<?php
				
				
				
				
								$result = mysqli_query($conn,"SELECT occopylocker.St_id, occopylocker.Locker_num, occopylocker.state FROM occopylocker, locker WHERE occopylocker.Locker_num=locker.Locker_num");
								echo "<table>";
								echo "<tr>";
								echo "<th>Locker Number</th>";
								echo "<th>Occupied/Not Occupied</th>";
								echo "<th>User</th>";
								echo "</tr>";
								while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td>".$row['Locker_num']."</td>";
										echo "<td>".$row['state']."</td>";
										echo "<td>".$row['St_id']."</td></tr>";

								}
								echo "</table>"
								?>

		
		</div> 	
		 <div class="Footer"></div>							                   <!--End of main container-->

	</body>
</html>
