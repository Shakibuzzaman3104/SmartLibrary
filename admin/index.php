<?php
ob_start();
session_start();
require_once '../dbconnect.php';

// if session is not set this will redirect to login page
if ( !isset( $_SESSION[ 'user' ] ) ) {
	header( "Location: index.php" );
	exit;
}
// select loggedin users detail
$res = mysqli_query( $conn, "SELECT * FROM admin WHERE admin_id=" . $_SESSION[ 'user' ] );
$userRow = mysqli_fetch_array( $res );
?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Welcome -
		<?php echo $userRow['admin_id']; ?>
	</title>
</head>

<body>
	<div class="container">
		<!--start of main container -->
		<div class="Header">
			<div class="Header_right">
				<a href="../logout.php?logout"><input class="button" type="button" value="Logout"></a>
			</div>
		</div>
		<div class="nav">
			<a href="index.php"><input class="button button10" type="button" value="Home" disabled></a>
			<a href="locker2.php"><input class="button button3"  type="button" value="Locker"></a>
			<a href="occupied.php"><input class="button button3" type="button" value="Locker State"></a>
			<a href="population.php"><input class="button button3" type="button" value="Population"></a>
			<a href="booking_table.php"><input class="button button3" type="button" value="Booking Table"></a>
		</div>
		<div class="container_body">
			<!--Start of container for body-->
			<div class="upper">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner">

						<div class="item active">
							<img src="../img/smatLibrary.jpg" alt="Los Angeles" style="width:100%;">
							<div class="carousel-caption">
								<h3>Smart Library</h3>
							</div>
						</div>

						<div class="item">
							<img src="../img/locker.jpg" alt="Los Angeles" style="width:100%;">
							<div class="carousel-caption">
								<h3>Smart Locker</h3>
								<p>Smart Locker is always efficient and secured</p>
							</div>
						</div>

						<div class="item">
							<img src="../img/table.jpg" alt="Chicago" style="width:100%;">
							<div class="carousel-caption">
								<h3>Smart Table Management</h3>
								<p>Life become Easy</p>
							</div>
						</div>

					</div>

					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
				
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
				
				</div>
			</div>
			<div class="Lower">
				<div class="Lowerl">
					<img src="../img/er.png" alt="Los Angeles" style="width:100%;">
				</div>
				<div class="Lowerr">
					<p>
						<h4>Students sometime travel a long way to study in the library but sometimes reaching there they find no table available for them. This system allow students to book table from anywhere using online interface and it also helps them to see if there is any table available or not.</h4> </p><br><br>

					<p>
						<h4>The locker occupying process has been made easier and hassle-free. Instead of using keys, students will be able to use their ID card to occupy a locker. Later, they can use the ID card and online interface to control the locker occupied by them.</h4>
					</p>
				</div>
			</div>
			<!--End of upper div-->

		</div>
		<!--End of container for body-->
		<div class="Footer"></div>
	</div>
	<!--End of main container-->

</body>

</html>