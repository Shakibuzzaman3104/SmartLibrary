<?php

	// this will avoid mysql_connect() deprecation error.
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	// but I strongly suggest you to use PDO or MySQLi.

	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBNAME', 'smartlocker');

	$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
	//$dbcon = mysql_select_db(DBNAME);

	if ( !$conn ) {
		die("Connection failed : " . mysqli_error($conn));
	}

	/*if ( !$dbcon ) {
		die("Database Connection failed : " . mysql_error());
	}*/
