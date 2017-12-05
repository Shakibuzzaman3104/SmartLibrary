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
				<a href="occupied.php" ><input class="button button3" type="button" value="Locker state"></a>
				<a href="population.php" ><input class="button button3" type="button" value="Population"></a>
				<a href="booking_table.php" ><input class="button button3" type="button" value="Booking table"></a>
			</div>
		  <div class="container_body"> 

		  <!--Start of container for body-->
		  
			<div class="upper" > 

			<div class="split" align="center">
			
				<div class="split_h" align="left">
					<center>
					<div class="split_h1" >
					<h2 >Floor: 1</h2> 
					</div>
					</center>
				</div>
				<div class="split2">
				<?php
								$result = mysqli_query($conn,"SELECT * FROM book_table WHERE floor_num=1");
								echo "<table>";
								echo "<tr>";
								echo "<th>Student ID</th>";
								echo "<th>Table Number</th>";
								echo "<th>Seat Number</th>";
								echo "</tr>";
								while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td>".$row['St_id']."</td>";
										echo "<td>".$row['table_num']."</td>";
										echo "<td>".$row['SeatNum']."</td>";
										echo "</tr>";

								}
								echo "</table>"
								?>

			
				</div>
			</div>
			<div class="split" align="center">
			
				<div class="split_h">
				
					<center>
					<div class="split_h1" >
					<h2 >Floor: 2</h2> 
					</div>
					</center>
				
				</div>
				<div class="split2">
				<?php
								$result = mysqli_query($conn,"SELECT * FROM book_table WHERE floor_num=2");
								echo "<table>";
								echo "<tr>";
								echo "<th>Student ID</th>";
								echo "<th>Table Number</th>";
								echo "<th>Seat Number</th>";
								echo "</tr>";
								while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td>".$row['St_id']."</td>";
										echo "<td>".$row['table_num']."</td>";
										echo "<td>".$row['SeatNum']."</td>";
										echo "</tr>";

								}
								echo "</table>"
								?>
				</div>
			</div>
			<div class="split" align="center">
			
				<div class="split_h">
				
					<center>
					<div class="split_h1" >
					<h2 >Floor: 3</h2> 
					</div>
					</center>
				
				</div>
				<div class="split2">
				<?php
								$result = mysqli_query($conn,"SELECT * FROM book_table WHERE floor_num=3");
								echo "<table>";
								echo "<tr>";
								echo "<th>Student ID</th>";
								echo "<th>Table Number</th>";
								echo "<th>Seat Number</th>";
								echo "</tr>";
								while ($row = mysqli_fetch_array($result)) {
										echo "<tr><td>".$row['St_id']."</td>";
										echo "<td>".$row['table_num']."</td>";
										echo "<td>".$row['SeatNum']."</td>";
										echo "</tr>";

								}
								echo "</table>"
								?>
				</div>
			</div>
				
		 
		</div>
		
		 
		   </div>
<div class="Footer"></div>		<!--End of main container-->

	</body>
</html>