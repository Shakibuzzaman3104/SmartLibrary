
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

$lock=mysqli_query($conn,"SELECT * FROM occopylocker where St_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($lock);
$rel= mysqli_query($conn,"UPDATE occopylocker set state='ON' where Locker_num=".$userRow['Locker_num']);

	header("Location: my_locker.php");
	
?>
