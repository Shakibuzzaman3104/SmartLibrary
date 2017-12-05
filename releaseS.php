
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


$test= mysqli_query($conn,"SELECT * FROM book_table where St_id=".$_SESSION['user']);
$store=mysqli_fetch_array($test);
$t=$store['table_num'];

$booking1=mysqli_query($conn,"SELECT * FROM booking_table where table_num=".$t);
$table=mysqli_fetch_array($booking1);
$dec=$table['occupied'];
$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$dec-1,available=(number_of_seat - occupied) where table_num=".$t);


$lock=mysqli_query($conn,"SELECT * FROM occopylocker where St_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($lock);

$rel= mysqli_query($conn,"UPDATE seat set flag=0 where SeatNum=".$_POST['release']);
$del= mysqli_query($conn,"DELETE FROM book_table where St_id=".$_SESSION['user']);



/*if(isset($_POST['release']))
{
	echo $_POST['release'];
}*/



	header("Location: booktable.php");
	
?>