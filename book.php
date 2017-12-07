
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

$var=$_POST['book'];

$u=$_SESSION['user'];
$hour=$_POST['hour'];
$min=$_POST['min'];


$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=11");
$table1=mysqli_fetch_array($booking);
$inct1=$table1['occupied'];

$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=12");
$table2=mysqli_fetch_array($booking);
$inct2=$table2['occupied'];

$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=13");
$table3=mysqli_fetch_array($booking);
$inct3=$table3['occupied'];

$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=14");
$table4=mysqli_fetch_array($booking);
$inct4=$table4['occupied'];



$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=21");
$table21=mysqli_fetch_array($booking);
$inct21=$table21['occupied'];

$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=22");
$table22=mysqli_fetch_array($booking);
$inct22=$table22['occupied'];

$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=23");
$table23=mysqli_fetch_array($booking);
$inct23=$table23['occupied'];

$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=24");
$table24=mysqli_fetch_array($booking);
$inct24=$table24['occupied'];


$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=31");
$table31=mysqli_fetch_array($booking);
$inct31=$table31['occupied'];

$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=32");
$table32=mysqli_fetch_array($booking);
$inct32=$table32['occupied'];

$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=33");
$table33=mysqli_fetch_array($booking);
$inct33=$table33['occupied'];

$booking=mysqli_query($conn,"SELECT * FROM booking_table where floor_num=1 AND table_num=34");
$table34=mysqli_fetch_array($booking);
$inct34=$table34['occupied'];
$time=$hour.':'.$min.':00';

switch($var)
{
	case "111":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num,start_time,occupy) VALUES(11,$var,$u,1,'$time',0)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct1+1,available=(number_of_seat - occupied) where table_num=11");
		break;
	case "112":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(11,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct1+1,available=(number_of_seat - occupied) where table_num=11");
		break;
	case "113":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(11,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct1+1,available=(number_of_seat - occupied) where table_num=11");
		break;	
	case "114":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(11,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct1+1,available=(number_of_seat - occupied) where table_num=11");
		break;
	case "115":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(11,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct1+1,available=(number_of_seat - occupied) where table_num=11");
		break;
	case "116":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(11,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct1+1,available=(number_of_seat - occupied) where table_num=11");
		break;	
		
	case "121":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(12,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct2+1,available=(number_of_seat - occupied) where table_num=12");
		break;
	case "122":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(12,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct2+1,available=(number_of_seat - occupied) where table_num=12");
		break;
	case "123":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(12,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct2+1,available=(number_of_seat - occupied) where table_num=12");
		break;
	case "124":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(12,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct2+1,available=(number_of_seat - occupied) where table_num=12");
		break;
	case "125":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(12,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct2+1,available=(number_of_seat - occupied) where table_num=12");
		break;	
	case "126":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(12,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct2+1,available=(number_of_seat - occupied) where table_num=12");
		break;	
		
	case "131":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(13,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct3+1,available=(number_of_seat - occupied) where table_num=13");
		break;
	case "132":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(13,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct3+1,available=(number_of_seat - occupied) where table_num=13");
		break;
	case "133":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(13,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct3+1,available=(number_of_seat - occupied) where table_num=13");
		break;
	case "134":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(13,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct3+1,available=(number_of_seat - occupied) where table_num=13");
		break;
	case "135":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(13,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct3+1,available=(number_of_seat - occupied) where table_num=13");
		break;	
	case "136":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(13,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct3+1,available=(number_of_seat - occupied) where table_num=13");
		break;	
		
	case "141":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(14,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct4+1,available=(number_of_seat - occupied) where table_num=14");
		break;
	case "142":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(14,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct4+1,available=(number_of_seat - occupied) where table_num=14");
		break;
	case "143":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(14,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct4+1,available=(number_of_seat - occupied) where table_num=14");
		break;
	case "144":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(14,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct4+1,available=(number_of_seat - occupied) where table_num=14");
		break;
	case "145":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(14,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct4+1,available=(number_of_seat - occupied) where table_num=14");
		break;	
	case "146":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(14,$var,$u,1)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct4+1,available=(number_of_seat - occupied) where table_num=14");
		break;	
		
		
	case "211":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(21,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct21+1,available=(number_of_seat - occupied) where table_num=21");
		break;
	case "212":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(21,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct21+1,available=(number_of_seat - occupied) where table_num=21");
		break;
	case "213":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(21,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct21+1,available=(number_of_seat - occupied) where table_num=21");
		break;	
	case "214":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(21,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct21+1,available=(number_of_seat - occupied) where table_num=21");
		break;
	case "215":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(21,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct21+1,available=(number_of_seat - occupied) where table_num=21");
		break;
	case "216":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(21,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct21+1,available=(number_of_seat - occupied) where table_num=21");
		break;	
		
	case "221":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(22,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct22+1,available=(number_of_seat - occupied) where table_num=22");
		break;
	case "222":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(22,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct22+1,available=(number_of_seat - occupied) where table_num=22");
		break;
	case "223":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(22,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct22+1,available=(number_of_seat - occupied) where table_num=22");
		break;
	case "224":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(22,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct22+1,available=(number_of_seat - occupied) where table_num=22");
		break;
	case "225":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(22,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct22+1,available=(number_of_seat - occupied) where table_num=22");
		break;	
	case "226":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(22,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct22+1,available=(number_of_seat - occupied) where table_num=22");
		break;	
		
	case "231":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(23,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct23+1,available=(number_of_seat - occupied) where table_num=23");
		break;
	case "232":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(23,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct23+1,available=(number_of_seat - occupied) where table_num=23");
		break;
	case "233":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(23,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct23+1,available=(number_of_seat - occupied) where table_num=23");
		break;
	case "234":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(23,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct23+1,available=(number_of_seat - occupied) where table_num=23");
		break;
	case "235":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(23,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct23+1,available=(number_of_seat - occupied) where table_num=23");
		break;	
	case "236":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(23,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct23+1,available=(number_of_seat - occupied) where table_num=23");
		break;	
		
	case "241":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(24,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct24+1,available=(number_of_seat - occupied) where table_num=24");
		break;
	case "242":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(24,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct24+1,available=(number_of_seat - occupied) where table_num=24");
		break;
	case "243":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(24,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct24+1,available=(number_of_seat - occupied) where table_num=24");
		break;
	case "244":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(24,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct24+1,available=(number_of_seat - occupied) where table_num=24");
		break;
	case "245":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(24,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct24+1,available=(number_of_seat - occupied) where table_num=24");
		break;	
	case "246":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(24,$var,$u,2)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct24+1,available=(number_of_seat - occupied) where table_num=24");
		break;	
	
		
	case "311":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(31,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct31+1,available=(number_of_seat - occupied) where table_num=31");
		break;
	case "312":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(31,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct31+1,available=(number_of_seat - occupied) where table_num=31");
		break;
	case "313":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(31,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct31+1,available=(number_of_seat - occupied) where table_num=31");
		break;	
	case "314":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(31,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct31+1,available=(number_of_seat - occupied) where table_num=31");
		break;
	case "315":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(31,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct31+1,available=(number_of_seat - occupied) where table_num=31");
		break;
	case "316":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(31,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct31+1,available=(number_of_seat - occupied) where table_num=31");
		break;	
		
	case "321":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(32,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct32+1,available=(number_of_seat - occupied) where table_num=32");
		break;
	case "322":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(32,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct32+1,available=(number_of_seat - occupied) where table_num=32");
		break;
	case "323":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(32,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct32+1,available=(number_of_seat - occupied) where table_num=32");
		break;
	case "324":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(32,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct32+1,available=(number_of_seat - occupied) where table_num=32");
		break;
	case "325":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(32,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct32+1,available=(number_of_seat - occupied) where table_num=32");
		break;	
	case "326":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(32,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct32+1,available=(number_of_seat - occupied) where table_num=32");
		break;	
		
	case "331":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(33,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct33+1,available=(number_of_seat - occupied) where table_num=33");
		break;
	case "332":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(33,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct33+1,available=(number_of_seat - occupied) where table_num=33");
		break;
	case "333":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(33,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct33+1,available=(number_of_seat - occupied) where table_num=33");
		break;
	case "334":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(33,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct33+1,available=(number_of_seat - occupied) where table_num=33");
		break;
	case "335":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(33,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct33+1,available=(number_of_seat - occupied) where table_num=33");
		break;	
	case "336":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(33,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct33+1,available=(number_of_seat - occupied) where table_num=33");
		break;	
		
	case "341":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(34,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct34+1,available=(number_of_seat - occupied) where table_num=34");
		break;
	case "342":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(34,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct34+1,available=(number_of_seat - occupied) where table_num=34");
		break;
	case "343":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(34,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct34+1,available=(number_of_seat - occupied) where table_num=34");
		break;
	case "344":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(34,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct34+1,available=(number_of_seat - occupied) where table_num=34");
		break;
	case "345":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(34,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct34+1,available=(number_of_seat - occupied) where table_num=34");
		break;	
	case "346":
		$rel= mysqli_query($conn,"UPDATE seat set flag=1 where SeatNum=".$var);
		$del= mysqli_query($conn,"INSERT INTO book_table(table_num,SeatNum,St_id,floor_num) VALUES(34,$var,$u,3)");
		$booking= mysqli_query($conn,"UPDATE booking_table SET occupied=$inct34+1,available=(number_of_seat - occupied) where table_num=34");
		break;		
}



/*if(isset($_POST['release']))
{
	echo $_POST['release'];
}*/



	header("Location: booktable.php");
	
?>