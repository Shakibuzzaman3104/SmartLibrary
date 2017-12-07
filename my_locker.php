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
$lock=$_POST['locker'];
$std_id=$_SESSION['user'];

?>
<!DOCTYPE html>
<html>

	<title>

	</title>

	 <head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="bootstrap.min.css">
	 
		<link rel="stylesheet" type="text/css" href="styles.css"/>
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
    					<a href="#">Change Password</a>
  						</div>
							</div>
				</div>
			</div>
				<div class="nav">
				<a href="home.php"><input class="button button3"  type="button" value="Home" ></a>
				<a href="my_locker.php"><input class="button button10"  type="button" value="My Locker" disabled></a>
				<a href="booktable.php"><input class="button button3" type="button" value="Book Table"></a>
			</div>
		  <div class="container_body"> 							    <!--Start of container for body-->
			<div class="upper" align="center">
				 <div class="button_space">
				<?php
					 
			$occ1=mysqli_query($conn,"INSERT INTO occopylocker(St_id,Locker_num,state) VALUES('$std_id',$lock,'OFF') ");
		    $check=mysqli_query($conn,"SELECT * FROM occopylocker where St_id =".$_SESSION['user']);
		    $userRow=mysqli_fetch_array($check);
					 
			$image1="img/locked.png";
			$image2="img/locked2.png";
			$image3="img/locked3.png";
			$image4="img/locked4.png";
					 
			if($occ1)
			{
				$occ= mysqli_query($conn,"UPDATE locker set flag=1 WHERE Locker_num=$lock");
				
			}
			 if($userRow['Locker_num'])
			{
				if($userRow['Locker_num']==1)
				{
					print"<img src=\"$image1\" width=\"280px\" height=\"300px\"\/>";
				}
				elseif($userRow['Locker_num']==2)
				{
					print"<img src=\"$image2\" width=\"280px\" height=\"300px\"\/>";
				}
				elseif($userRow['Locker_num']==3)
				{
					print"<img src=\"$image3\" width=\"280px\" height=\"300px\"\/>";
				}
				else
				{
					print"<img src=\"$image4\" width=\"280px\" height=\"300px\"\/>";
				}
				
				/*print "<input class=\"button button5\" type=\"button\" value=\"open\" name =\"submit_button\" >";
				print "<input class=\"button button6\" type=\"button\" value=\"close\" >";*/
				
				print "<form action=\"open.php\" method=\"post\">
        		<button class=\"button button5\" type=\"submit\" name=\"open\" value=\"0\">Open</button>
				</form>";
				
				print "<form action=\"close.php\" method=\"post\">
        		<button class=\"button button6\" type=\"submit\" name=\"close\" value=\"0\">Close</button>
				</form>";
				
				print "<form action=\"release.php\" method=\"post\">
        		<button class=\"button button7\" type=\"submit\" name=\"release\" value=\"0\">Release</button>
				</form>";
			}
				?>
				<!--<img src="img/locked.png" height="300px" width="280px">
				<input class="button button5" type="button" value="open">
				<form method="post" action="release.php">
				<button class="button button7" type="submit" name="release" value="0">Release</button>
			</form>-->
				</div>
				
			</div>
			</div> <!--End of Lower div-->
			<div class="Footer"></div>
		  </div> 											   <!--End of container for body-->

									                   <!--End of main container-->

	</body>
</html>
