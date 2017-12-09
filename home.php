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
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles.css"/>
	<title>Welcome - <?php echo $userRow['St_id']; ?></title>
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
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
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
				<div class="nav">                                     <!-- Start of navition -->
				<a href="home.php"><input class="button button10"  type="button" value="Home" disabled></a>
				<a href="my_locker.php"><input class="button button3"  type="button" value="My Locker"></a>
				<a href="booktable.php"><input class="button button3" type="button" value="Book Table"></a>
			</div>
		  <div class="container_body"> 							    <!--Start of container for body-->
			<div class="upper"> 							        <!--Start of upper div-->
				<div class="upper_left">
					<?php	if ($lockquery['Locker_num']==1 && $lockquery['flag']==0){ ?>

							<img src="img/unlocked.png" height="280px" width="260px">
							<div class="button_space">
							<!--<form method="POST" action="my_locker.php" >
							<button class="button button1" name="locker" value="1">Occupy</button>
							</form>-->
						</div>
						<?php	}	?>
					<?php	if ($lockquery['Locker_num']==1 && $lockquery['flag']==1){ ?>
								<img src="img/locked.png" height="280px" width="260px">
								<div class="button_space">

							</div>
							<?php	}	?>
				</div>

				<div class="upper_leftn">
					<?php
					$locker2=mysqli_query($conn,"SELECT * FROM locker");
					$lockquery2=mysqli_fetch_array($locker);
					if ($lockquery2['Locker_num']==2 && $lockquery2['flag']==0){ ?>

							<img src="img/unlocked2.png" height="280px" width="260px">
							<div class="button_space">
							<!--<form method="post" action="my_locker.php" >
							<button class="button button1" name="locker" value="2">Occupy</button>
							</form>-->
						</div>
						<?php	}	?>
					<?php	if ($lockquery2['Locker_num']==2 && $lockquery2['flag']==1){ ?>
								<img src="img/locked.png" height="280px" width="260px">
								<div class="button_space">

							</div>
							<?php	}	?>
				</div>
				<div class="upper_center">
					<?php
					$locker3=mysqli_query($conn,"SELECT * FROM locker");
					$lockquery3=mysqli_fetch_array($locker);
					if ($lockquery3['Locker_num']==3 && $lockquery3['flag']==0){ ?>

							<img src="img/unlocked3.png" height="280px" width="260px">
							<div class="button_space">
							<!--<form method="post" action="my_locker.php" >
							<button class="button button1" name="locker" value="3">Occupy</button>
							</form>-->
						</div>
						<?php	}	?>
					<?php	if ($lockquery3['Locker_num']==3 && $lockquery3['flag']==1){ ?>
								<img src="img/locked3.png" height="280px" width="260px">
								<div class="button_space">

							</div>
							<?php	}	?>
				</div>
				<div class="upper_right">
					<?php
					$locker4=mysqli_query($conn,"SELECT * FROM locker");
					$lockquery4=mysqli_fetch_array($locker);
					if ($lockquery4['Locker_num']==4 && $lockquery4['flag']==0){ ?>

							<img src="img/unlocked4.png" height="280px" width="260px">
							<div class="button_space">
							<!--<form method="post" action="my_locker.php" >
							<button class="button button1" name="locker" value="4">Occupy</button>
							</form>-->
						</div>
						<?php	}	?>
					<?php	if ($lockquery4['Locker_num']==4 && $lockquery4['flag']==1){ ?>
								<img src="img/locked4.png" height="280px" width="260px">
								<div class="button_space">

							</div>
							<?php	}	?>
				</div>
			</div>  								                  <!--End of upper div-->
								                   <!--End of Lower div-->
		  </div> 											   <!--End of container for body-->
		 <div class="Footer"></div>
		</div> 								                   <!--End of main container-->

	</body>
</html>
