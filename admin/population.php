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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<script src="jquery-3.2.1.min.js" type="text/javascript"></script>
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
				<a href="occupied.php" ><input class="button button3" type="button" value="Locker State"></a>
				<a href="population.php" ><input class="button button10" type="button" value="Population" disabled></a>
				<a href="booking_table.php" ><input class="button button3" type="button" value="Booking Table"></a>
			</div>
		  <div class="container_body"> 

		  <!--Start of container for body-->
		  
			<div class="upper" > 

			<div class="split" align="center">
			
				<div class="split_h" align="left">
					<center>
					<div class="split_h1" >
					Floor: <a href="floor.php">1</a>
					</div>
					<div class="split_h2">
						Total Student
					</div>
					<div class="split_h3">
						Total Seat: 18
					</div>
					<div class="split_h4">
						Available Seat:
						<?php
						 	$total=18;
						    $res=mysqli_query($conn,"SELECT SUM(occupied) AS occ FROM booking_table WHERE floor_num=1");
							$fin=mysqli_fetch_array($res);	
							print $total-$fin[0];
						?>
					</div>
					</center>
				</div>
				<div class="split2">
				<?php
								$result = mysqli_query($conn,"SELECT table_num,number_of_seat,occupied,available FROM booking_table WHERE floor_num=1");
								echo "<table>";
								echo "<tr>";
								echo "<th>Table Number</th>";
								echo "<th>Total seat</th>";
								echo "<th>Occupied Seat</th>";
								echo "<th>Available Seat</th>";
								echo "</tr>";
								while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td>".$row['table_num']."</td>";
										echo "<td>".$row['number_of_seat']."</td>";
										echo "<td>".$row['occupied']."</td>";
										echo "<td>".$row['available']."</td></tr>";

								}
								echo "</table>"
								?>

			
				</div>
			</div>
			<div class="split" align="center">
			
				<div class="split_h">
				
					<center>
					<div class="split_h1" >
					Floor: <a href="floor.php">2</a>
					</div>
					<div class="split_h2">
						Total Student
					</div>
					<div class="split_h3">
						Total Seat: 18
					</div>
					<div class="split_h4">
						Available Seat:
						<?php
						 	$total=18;
						    $res=mysqli_query($conn,"SELECT SUM(occupied) AS occ FROM booking_table WHERE floor_num=2");
							$fin=mysqli_fetch_array($res);	
							print $total-$fin[0];
						?>
					</div>
					</center>
				
				</div>
				
				<?php
								$result = mysqli_query($conn,"SELECT table_num,number_of_seat,occupied,available FROM booking_table WHERE floor_num=2");
								echo "<table>";
								echo "<tr>";
								echo "<th>Table Number</th>";
								echo "<th>Total seat</th>";
								echo "<th>Occupied Seat</th>";
								echo "<th>Available Seat</th>";
								echo "</tr>";
								while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td>".$row['table_num']."</td>";
										echo "<td>".$row['number_of_seat']."</td>";
										echo "<td>".$row['occupied']."</td>";
										echo "<td>".$row['available']."</td></tr>";

								}
								echo "</table>"
								?>
				
			</div>
			<div class="split" align="center">
			
				<div class="split_h">
				
					<center>
					<div class="split_h1" >
					Floor: <a href="floor.php">3</a>
					</div>
					<div class="split_h2">
						Total Student
					</div>
					<div class="split_h3">
						Total Seat: 18
					</div>
					<div class="split_h4">
						Available Seat:
						<?php
						 	$total=18;
						    $res=mysqli_query($conn,"SELECT SUM(occupied) AS occ FROM booking_table WHERE floor_num=3");
							$fin=mysqli_fetch_array($res);	
							print $total-$fin[0];
						?>
					</div>
					</center>
				
				</div>
				
				<?php
								$result = mysqli_query($conn,"SELECT table_num,number_of_seat,occupied,available FROM booking_table WHERE floor_num=3");
								echo "<table>";
								echo "<tr>";
								echo "<th>Table Number</th>";
								echo "<th>Total seat</th>";
								echo "<th>Occupied Seat</th>";
								echo "<th>Available Seat</th>";
								echo "</tr>";
								while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td>".$row['table_num']."</td>";
										echo "<td>".$row['number_of_seat']."</td>";
										echo "<td>".$row['occupied']."</td>";
										echo "<td>".$row['available']."</td></tr>";

								}
								echo "</table>"
								?>
				
			</div>
				
		 
		</div>
		
		 
		   </div>
<div class="Footer"></div>		<!--End of main container-->

	</body>
</html>
