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
			<div class="nav">                                       
				<a href="index.php" ><input class="button button3" type="button" value="Home"></a>
				<a href="locker2.php"><input class="button button10"  type="button" value="Locker" disabled></a>
				<a href="occupied.php" ><input class="button button3" type="button" value="Locker State"></a>
				<a href="population.php" ><input class="button button3" type="button" value="Population"></a>
				<a href="booking_table.php" ><input class="button button3" type="button" value="Booking Table"></a>
			</div>
		  <div class="container_body"> 							    <!--Start of container for body-->
			<div class="upper"> 							        <!--Start of upper div-->

				<div class="upper_left">
				<?php
					
					$sql=mysqli_query($conn,"SELECT * FROM occopylocker where locker_num=1");
					$result=mysqli_fetch_array($sql);
					$image1="img/unlocked.png";
					$image2="img/unlocked2.png";
					$image3="img/unlocked3.png";
					$image4="img/unlocked4.png";
					
					$image5="img/locked.png";
					$image6="img/locked2.png";
					$image7="img/locked3.png";
					$image8="img/locked4.png";
					
					if($result['state']=="OFF")
					{
						print"<img src=\"$image5\" width=\"260px\" height=\"280px\"\/>";
						print '<div class="button_space">'."<form action=\"release.php\" method=\"post\">
        		<button class=\"button button2\" type=\"submit\" name=\"release\" value=\"0\">Release</button>
				</form>".'</div>';
						
					}
					else
					{
						print"<img src=\"$image1\"  width=\"260px\" height=\"280px\"\/>";
						
					}
					
					?>
<!--
				<img src="unlocked.png" height="300px" width="280px">
				    <div class="button_space">
-->

					
				</div>
				<div class="upper_leftn">
				<?php
					
					$sql=mysqli_query($conn,"SELECT * FROM occopylocker where locker_num=2");
					$result=mysqli_fetch_array($sql);
					if($result['state']=="OFF")
					{
						print"<img src=\"$image6\"  width=\"260px\" height=\"280px\"\/>";
						print '<div class="button_space">'."<form action=\"release.php\" method=\"post\">
        		<button class=\"button button2\" type=\"submit\" name=\"release\" value=\"0\">Release</button>
				</form>".'</div>';
						
					}
					else
					{
						print"<img src=\"$image2\"  width=\"260px\" height=\"280px\"\/>";
						
					}
					
					?>
				</div>
				<div class="upper_center">
				<?php
					
					$sql=mysqli_query($conn,"SELECT * FROM occopylocker where locker_num=3");
					$result=mysqli_fetch_array($sql);
					if($result['state']=="OFF")
					{
						print"<img src=\"$image7\"  width=\"260px\" height=\"280px\"\/>";
						print '<div class="button_space">'."<form action=\"release.php\" method=\"post\">
        		<button class=\"button button2\" type=\"submit\" name=\"release\" value=\"0\">Release</button>
				</form>".'</div>';
						
					}
					else
					{
						print"<img src=\"$image3\"  width=\"260px\" height=\"280px\"\/>";
						
					}
					
					?>
				</div>
				<div class="upper_right">
				<?php
					
					$sql=mysqli_query($conn,"SELECT * FROM occopylocker where locker_num=4");
					$result=mysqli_fetch_array($sql);
					if($result['state']=="OFF")
					{
						print"<img src=\"$image8\"  width=\"260px\" height=\"280px\"\/>";
					print '<div class="button_space">'."<form action=\"release.php\" method=\"post\">
        		<button class=\"button button2\" type=\"submit\" name=\"release\" value=\"0\">Release</button>
				</form>".'</div>';
						
					}
					else
					{
						print"<img src=\"$image4\"  width=\"260px\" height=\"280px\"\/>";
						
					}
					
					?>
				</div>
			</div>  								                  <!--End of upper div-->

		  </div> 											   <!--End of container for body-->
		 <div class="Footer"></div>
		</div> 								                   <!--End of main container-->

	</body>
</html>
