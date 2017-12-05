
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

$lock=mysqli_query($conn,"SELECT * FROM occopylocker");
$userRow=mysqli_fetch_array($lock);
$rel= mysqli_query($conn,"UPDATE locker set flag=0 where Locker_num=".$userRow['Locker_num']);
$del= mysqli_query($conn,"DELETE FROM occopylocker where Locker_num=".$userRow['Locker_num']);

	header("Location: index.php");
	
?>
