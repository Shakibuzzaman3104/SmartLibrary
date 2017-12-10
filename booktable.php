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
<html>

<head>
 	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styleb.css"/>
	<title>Welcome -
		<?php echo $userRow['St_id']; ?>
	</title>
</head>

<body>

	<div class="container">
	<?php 
		$check=0;
		$r1=mysqli_query($conn,"select * from book_table where St_id=".$userRow['St_id']);
		$r2=mysqli_fetch_array($r1);
		if(!is_null($r2))
		{
			$check=1;
		}
		?>
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
		<div class="nav">
				<a href="home.php"><input class="button button3"  type="button" value="Home"></a>
				<a href="locker.php"><input class="button button3"  type="button" value="Locker"></a>
				<a href="my_locker.php"><input class="button button3"  type="button" value="My Locker"></a>
				<a href="booktable.php"><input class="button button10" type="button" value="Book Table" disabled></a>
		</div>
		<div class="container_body">
			<div class="upper">
				<div class="details">
					<div class="details1">Floor: 1</div>
					<div class="details2">Total Student: <?php
						$std=mysqli_query($conn,"SELECT count(*)FROM current_std Where floor_num=1");
						$std2=mysqli_fetch_array($std);
						print $std2[0];
						?></div>
					<div class="details3">Total Seat: 18</div>
					<div class="details4">Available Seat:<?php
						 	$total=18;
						    $res=mysqli_query($conn,"SELECT SUM(occupy) AS occ FROM book_table WHERE floor_num=1 AND occupy=0");
							$fin=mysqli_fetch_array($res);
							$sum=$std2[0]+$fin[0];
							$seat=$total-$std2[0];
							if($seat<1)
							{
								print "0";
							}
							else
							{
								print $seat;
							}	
						?> </div>
				</div>
				<div class="upper_left">
					<div class="det">
						<div class="det1">Table No:1</div>
						<div class="det2">Total Seat:6</div>
						<div class="det3">Available Seat:
							<?php 
						$res=mysqli_query($conn,"SELECT (number_of_seat - occupied) FROM booking_table WHERE table_num=11 AND floor_num=1");
						$fin=mysqli_fetch_array($res);	
							if(is_null($fin[0]))
							{
								echo '6';
							}
							else
								echo $fin[0];
							?>
						</div>
					</div>
					<div class="upper_left1">
						<div class="divide1">
							<div class="text_divider"><button class="button text" disabled>Seat 1:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=11 AND SeatNum=111 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=111" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );
								
								
								if ( $userRow['St_id' ] == $res1['St_id' ] ) {
									$check=1;
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"111\">Release</button>
									</form>";
									
								} elseif ( $res2[ 'flag' ] == 1) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\" >
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"111\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\" >
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"111\" disabled>Book</button>
									</form>";*/
								}
								
								elseif($check==0) {
									
									
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"111\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"111\" >Book</button>
									</form>";
								}

								?>
								<!--<form method="POST" action="">
							<button class="button button_divider" name="release" value="">Release</button>
							<button class="button button_divider1" name="book" value="">Book</button>
							</form>-->
							</div>
						</div>
						<div class="divide2">
							<div class="text_divider"><button class="button text" disabled>Seat 2:</button>
							</div>
							<div class="divide_button">

								<?php
								$sql1 = mysqli_query( $conn, "select * from book_table where table_num=11 AND SeatNum=112 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=112" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow['St_id' ] == $res1['St_id' ] ) {
									$check=1;
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"112\">Release</button>
									</form>";
									
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";/*
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\" disabled>
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"112\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\" disabled>
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"112\" disabled>Book</button>
									</form>";*/
								}
								
								elseif($check==0){
									
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\" >
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"112\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\" >
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"112\">Book</button>
									</form>";
								}

								?>

							</div>
						</div>
						<div class="divide3">
							<div class="text_divider"><button class="button text" disabled>Seat 3:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=11 AND SeatNum=113 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=113" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"113\">Release</button>
									</form>";
									$check=1;
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\" disabled>
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"112\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\" disabled>
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"112\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"113\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"113\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide4">
							<div class="text_divider"><button class="button text" disabled>Seat 4:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=11 AND SeatNum=114 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=114" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"114\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"114\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"114\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"114\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"114\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide5">
							<div class="text_divider"><button class="button text" disabled>Seat 5:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=11 AND SeatNum=115 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=115" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"115\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"115\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"115\" disabled>Book</button>
									</form>";*/
								}
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"115\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"115\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide6">
							<div class="text_divider"><button class="button text" disabled>Seat 6:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=11 AND SeatNum=116 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=116" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"116\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"116\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"116\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"116\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"116\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
					</div>

				</div>

				<div class="upper_leftn">

					<div class="det">
						<div class="det1">Table No:2</div>
						<div class="det2">Total Seat:6</div>
						<div class="det3">Available Seat:
							<?php 
						$res=mysqli_query($conn,"SELECT (number_of_seat - occupied) FROM booking_table WHERE table_num=12 AND floor_num=1");
						$fin=mysqli_fetch_array($res);	
							if(is_null($fin[0]))
							{
								echo '6';
							}
							else
								echo $fin[0];
							?>
						</div>
					</div>
					<div class="upper_left1">
						<div class="divide1">
							<div class="text_divider"><button class="button text" disabled>Seat 1:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=12 AND SeatNum=121 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=121" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"121\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"121\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"121\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"121\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"121\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide2">
							<div class="text_divider"><button class="button text" disabled>Seat 2:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=12 AND SeatNum=122 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=122" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"122\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"122\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"122\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"122\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"122\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide3">
							<div class="text_divider"><button class="button text" disabled>Seat 3:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=12 AND SeatNum=123 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=123" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"123\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"123\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"123\" diabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"123\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"123\">Book</button>
									</form>";
								}

								?>
								
							</div>
						</div>
						<div class="divide4">
							<div class="text_divider"><button class="button text" disabled>Seat 4:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=12 AND SeatNum=124 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=124" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"124\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"124\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"124\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"124\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"124\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide5">
							<div class="text_divider"><button class="button text" disabled>Seat 5:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=12 AND SeatNum=125 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=125" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"125\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"125\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"125\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"125\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"125\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide6">
							<div class="text_divider"><button class="button text" disabled>Seat 6:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=12 AND SeatNum=126 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=126" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"126\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"126\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"126\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"126\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"126\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
					</div>

				</div>
				<div class="upper_center">
					<div class="det">
						<div class="det1">Table No:3</div>
						<div class="det2">Total Seat:6</div>
						<div class="det3">Available Seat:
							<?php 
						$res=mysqli_query($conn,"SELECT (number_of_seat - occupied) FROM booking_table WHERE table_num=13 AND floor_num=1");
						$fin=mysqli_fetch_array($res);	
							if(is_null($fin[0]))
							{
								echo '6';
							}
							else
								echo $fin[0];
							?>
						</div>
					</div>
					<div class="upper_left1">
						<div class="divide1">
							<div class="text_divider"><button class="button text" disabled>Seat 1:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=13 AND SeatNum=131 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=131" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"131\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"131\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"131\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"131\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"131\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide2">
							<div class="text_divider"><button class="button text" disabled>Seat 2:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=13 AND SeatNum=132 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=132" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"132\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"132\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"132\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"132\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"132\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide3">
							<div class="text_divider"><button class="button text" disabled>Seat 3:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=13 AND SeatNum=133 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=133" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"133\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"133\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"133\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"133\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"133\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide4">
							<div class="text_divider"><button class="button text" disabled>Seat 4:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=13 AND SeatNum=134 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=134" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"134\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"134\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"134\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"134\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"134\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide5">
							<div class="text_divider"><button class="button text" disabled>Seat 5:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=13 AND SeatNum=135 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=135" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"135\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"135\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"135\">Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"135\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"135\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide6">
							<div class="text_divider"><button class="button text" disabled>Seat 6:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=13 AND SeatNum=136 AND floor_num=1" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=136" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"136\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"136\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"136\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"136\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"136\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
					</div>
				</div>
				
			</div>


			<div class="upper">
				<div class="details">
					<div class="details1">Floor: 2</div>
					<div class="details2">Total Student: <?php
						$std=mysqli_query($conn,"SELECT count(*)FROM current_std Where floor_num=2");
						$std2=mysqli_fetch_array($std);
						print $std2[0];
						?></div>
					<div class="details3">Total Seat: 18</div>
					<div class="details4">Available Seat:<?php
						 	$total=18;
						    $res=mysqli_query($conn,"SELECT SUM(occupy) AS occ FROM book_table WHERE floor_num=2 AND occupy=0");
							$fin=mysqli_fetch_array($res);
							$sum=$std2[0]+$fin[0];
							$seat=$total-$std2[0];
							if($seat<1)
							{
								print "0";
							}
							else
							{
								print $seat;
							}	
						?> </div>
				</div>
				<div class="upper_left">
					<div class="det">
						<div class="det1">Table No:1</div>
						<div class="det2">Total Seat:6</div>
						<div class="det3">Available Seat:
							<?php 
						$res=mysqli_query($conn,"SELECT (number_of_seat - occupied) FROM booking_table WHERE table_num=21 AND floor_num=2");
						$fin=mysqli_fetch_array($res);	
							if(is_null($fin[0]))
							{
								echo '6';
							}
							else
								echo $fin[0];
							?>
						</div>
					</div>
					<div class="upper_left1">
						<div class="divide1">
							<div class="text_divider"><button class="button text" disabled>Seat 1:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=21 AND SeatNum=211 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=211" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"211\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"211\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"211\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"211\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"211\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide2">
							<div class="text_divider"><button class="button text" disabled>Seat 2:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=21 AND SeatNum=212 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=212" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"212\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"212\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"212\">Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"212\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"212\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide3">
							<div class="text_divider"><button class="button text" disabled>Seat 3:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=21 AND SeatNum=213 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=213" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"213\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"213\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"213\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"213\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"213\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide4">
							<div class="text_divider"><button class="button text" disabled>Seat 4:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=21 AND SeatNum=214 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=214" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"214\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"214\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"214\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"214\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"214\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide5">
							<div class="text_divider"><button class="button text" disabled>Seat 5:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=21 AND SeatNum=215 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=215" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"215\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"215\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"215\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"215\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"215\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide6">
							<div class="text_divider"><button class="button text" disabled>Seat 6:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=21 AND SeatNum=216 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=216" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"216\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"216\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"216\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"216\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"216\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
					</div>

				</div>

				<div class="upper_leftn">

					<div class="det">
						<div class="det1">Table No:2</div>
						<div class="det2">Total Seat:6</div>
						<div class="det3">Available Seat:
							<?php 
						$res=mysqli_query($conn,"SELECT (number_of_seat - occupied) FROM booking_table WHERE table_num=22 AND floor_num=2");
						$fin=mysqli_fetch_array($res);	
							if(is_null($fin[0]))
							{
								echo '6';
							}
							else
								echo $fin[0];
							?>
						</div>
					</div>
					<div class="upper_left1">
						<div class="divide1">
							<div class="text_divider"><button class="button text" disabled>Seat 1:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=22 AND SeatNum=221 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=221" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"221\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"221\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"221\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"221\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"221\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide2">
							<div class="text_divider"><button class="button text" disabled>Seat 2:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=22 AND SeatNum=222 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=222" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"222\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"222\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"222\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"222\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"222\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide3">
							<div class="text_divider"><button class="button text" disabled>Seat 3:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=22 AND SeatNum=223 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=223" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"223\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"223\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"223\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"223\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"223\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide4">
							<div class="text_divider"><button class="button text" disabled>Seat 4:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=22 AND SeatNum=224 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=224" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"224\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"224\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"224\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"224\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"224\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide5">
							<div class="text_divider"><button class="button text" disabled>Seat 5:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=22 AND SeatNum=225 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=225" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"225\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"225\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"225\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"225\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"225\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide6">
							<div class="text_divider"><button class="button text" disabled>Seat 6:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=22 AND SeatNum=226 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=226" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"226\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"226\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"226\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"226\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"226\">Book</button>
									</form>";
								}

								?>

							</div>
						</div>
					</div>

				</div>
				<div class="upper_center">
					<div class="det">
						<div class="det1">Table No:3</div>
						<div class="det2">Total Seat:6</div>
						<div class="det3">Available Seat:
							<?php 
						$res=mysqli_query($conn,"SELECT (number_of_seat - occupied) FROM booking_table WHERE table_num=23 AND floor_num=2");
						$fin=mysqli_fetch_array($res);	
							if(is_null($fin[0]))
							{
								echo '6';
							}
							else
								echo $fin[0];
							?>
						</div>
					</div>
					<div class="upper_left1">
						<div class="divide1">
							<div class="text_divider"><button class="button text" disabled>Seat 1:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=23 AND SeatNum=231 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=231" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"231\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"231\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"231\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"231\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"231\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide2">
							<div class="text_divider"><button class="button text" disabled>Seat 2:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=23 AND SeatNum=232 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=232" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"232\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"232\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"232\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"232\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"232\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide3">
							<div class="text_divider"><button class="button text" disabled>Seat 3:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=23 AND SeatNum=233 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=233" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"233\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"233\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"233\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"233\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"233\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide4">
							<div class="text_divider"><button class="button text" disabled>Seat 4:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=23 AND SeatNum=234 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=234" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"234\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"234\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"234\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"234\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"234\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide5">
							<div class="text_divider"><button class="button text" disabled>Seat 5:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=23 AND SeatNum=235 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=235" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"235\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"235\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"235\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"235\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"235\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide6">
							<div class="text_divider"><button class="button text" disabled>Seat 6:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=23 AND SeatNum=236 AND floor_num=2" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=236" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"236\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"236\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"236\" disabled>Book</button>
									</form>";*/
								}
									
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"236\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"236\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<div class="upper">
				<div class="details">
					<div class="details1">Floor: 3</div>
					<div class="details2">Total Student: <?php
						$std=mysqli_query($conn,"SELECT count(*)FROM current_std Where floor_num=3");
						$std2=mysqli_fetch_array($std);
						print $std2[0];
						?></div>
					<div class="details3">Total Seat: 18</div>
					<div class="details4">Available Seat:<?php
						 	$total=18;
						    $res=mysqli_query($conn,"SELECT SUM(occupy) AS occ FROM book_table WHERE floor_num=3 AND occupy=0");
							$fin=mysqli_fetch_array($res);
							$sum=$std2[0]+$fin[0];
							$seat=$total-$std2[0];
							if($seat<1)
							{
								print "0";
							}
							else
							{
								print $seat;
							}	
						?> </div>
				</div>
				<div class="upper_left">
					<div class="det">
						<div class="det1">Table No:1</div>
						<div class="det2">Total Seat:6</div>
						<div class="det3">Available Seat:
							<?php 
						$res=mysqli_query($conn,"SELECT (number_of_seat - occupied) FROM booking_table WHERE table_num=31 AND floor_num=3");
						$fin=mysqli_fetch_array($res);	
							if(is_null($fin[0]))
							{
								echo '6';
							}
							else
								echo $fin[0];
							?>
						</div>
					</div>
					<div class="upper_left1">
						<div class="divide1">
							<div class="text_divider"><button class="button text" disabled>Seat 1:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=31 AND SeatNum=311 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=311" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"311\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"311\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"311\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"311\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"311\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide2">
							<div class="text_divider"><button class="button text" disabled>Seat 2:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=31 AND SeatNum=312 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=312" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"312\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"312\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"312\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"312\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"312\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide3">
							<div class="text_divider"><button class="button text" disabled>Seat 3:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=31 AND SeatNum=313 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=313" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"313\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"313\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"313\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"313\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"313\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide4">
							<div class="text_divider"><button class="button text" disabled>Seat 4:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=31 AND SeatNum=314 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=314" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"314\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"314\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"314\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"314\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"314\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide5">
							<div class="text_divider"><button class="button text" disabled>Seat 5:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=31 AND SeatNum=315 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=315" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"315\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"315\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"315\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"315\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"315\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide6">
							<div class="text_divider"><button class="button text" disabled>Seat 6:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=31 AND SeatNum=316 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=316" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"316\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"316\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"316\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"316\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"316\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
					</div>

				</div>

				<div class="upper_leftn">

					<div class="det">
						<div class="det1">Table No:2</div>
						<div class="det2">Total Seat:6</div>
						<div class="det3">Available Seat:
							<?php 
						$res=mysqli_query($conn,"SELECT (number_of_seat - occupied) FROM booking_table WHERE table_num=32 AND floor_num=3");
						$fin=mysqli_fetch_array($res);	
							if(is_null($fin[0]))
							{
								echo '6';
							}
							else
								echo $fin[0];
							?>
						</div>
					</div>
					<div class="upper_left1">
						<div class="divide1">
							<div class="text_divider"><button class="button text" disabled>Seat 1:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=32 AND SeatNum=321 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=321" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"321\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"321\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"321\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"321\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"321\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide2">
							<div class="text_divider"><button class="button text" disabled>Seat 2:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=32 AND SeatNum=322 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=322" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"322\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"322\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"322\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"322\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"322\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide3">
							<div class="text_divider"><button class="button text" disabled>Seat 3:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=32 AND SeatNum=323 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=323" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"323\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"323\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"323\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"323\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"323\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide4">
							<div class="text_divider"><button class="button text" disabled>Seat 4:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=32 AND SeatNum=324 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=324" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"324\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"324\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"324\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"324\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"324\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide5">
							<div class="text_divider"><button class="button text" disabled>Seat 5:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=32 AND SeatNum=325 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=325" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"325\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"325\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"325\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"325\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"325\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide6">
							<div class="text_divider"><button class="button text" disabled>Seat 6:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=32 AND SeatNum=326 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=326" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"326\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"326\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"326\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"326\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"326\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
					</div>

				</div>
				<div class="upper_center">
					<div class="det">
						<div class="det1">Table No:3</div>
						<div class="det2">Total Seat:6</div>
						<div class="det3">Available Seat:
							<?php 
						$res=mysqli_query($conn,"SELECT (number_of_seat - occupied) FROM booking_table WHERE table_num=33 AND floor_num=3");
						$fin=mysqli_fetch_array($res);	
							if(is_null($fin[0]))
							{
								echo '6';
							}
							else
								echo $fin[0];
							?>
						</div>
					</div>
					<div class="upper_left1">
						<div class="divide1">
							<div class="text_divider"><button class="button text" disabled>Seat 1:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=33 AND SeatNum=331 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=331" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"331\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"331\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"331\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"331\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"331\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide2">
							<div class="text_divider"><button class="button text" disabled>Seat 2:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=33 AND SeatNum=332 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=332" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"332\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"332\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"332\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"332\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"332\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide3">
							<div class="text_divider"><button class="button text" disabled>Seat 3:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=33 AND SeatNum=333 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=333" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"333\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"333\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"333\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"333\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"333\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide4">
							<div class="text_divider"><button class="button text" disabled>Seat 4:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=33 AND SeatNum=334 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=334" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"334\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"334\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"334\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"334\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"334\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide5">
							<div class="text_divider"><button class="button text" disabled>Seat 5:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=33 AND SeatNum=335 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=335" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"335\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"335\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"335\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"335\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"335\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
						<div class="divide6">
							<div class="text_divider"><button class="button text" disabled>Seat 6:</button>
							</div>
							<div class="divide_button">
								<?php
								$sql1 = mysqli_query( $conn, "select St_id from book_table where table_num=33 AND SeatNum=336 AND floor_num=3" );
								$sql2 = mysqli_query( $conn, "Select flag FROM seat WHERE SeatNum=336" );
								$res1 = mysqli_fetch_array( $sql1 );
								$res2 = mysqli_fetch_array( $sql2 );

								if ( $userRow[ 'St_id' ] == $res1[ 'St_id' ] ) {
									print "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"336\">Release</button>
									</form>";
								} elseif ( $res2[ 'flag' ] == 1 ) {
									echo "<button class=\"button occu\" disabled>Booked</button>";
								}
								
								elseif($check==1)
								{
									echo "<button class=\"button occus\" disabled>Unavailable</button>";
									/*echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"336\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"336\" disabled>Book</button>
									</form>";*/
								}
								
								else {
									echo "<form action=\"releaseS.php\" method=\"post\" style =\"float: right\">
        							<button class=\"button button_divider\" type=\"submit\" name=\"release\" value=\"336\" disabled>Release</button>
									</form>";
									echo "<form action=\"myseat.php\" method=\"post\" style =\"float: left\">
        							<button class=\"button button_divider1\" type=\"submit\" name=\"book\" value=\"336\">Book</button>
									</form>";
								}

								?>
							</div>
						</div>
					</div>
				</div>
				
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