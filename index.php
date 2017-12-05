<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';

	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['user'])!="" ) {
		header("Location: home.php");
		exit;
	}

	$error = false;

	if( isset($_POST['btn-login']) ) {

		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs

		if(empty($email)){
			$error = true;
			$emailError = "Please enter your user name.";
		}

		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}

		// if there's no error, continue to login
		if (!$error) {

			$password =$pass; // password hashing using SHA256
			$selected_radio = $_POST['users'];
            if($selected_radio=='User') {
			$res=mysqli_query($conn,"SELECT St_id,St_name, St_pass,St_dept FROM student WHERE St_id='$email'");
			$row=mysqli_fetch_array($res);
			$count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row




			if( $count == 1 && $row['St_pass']==$password) {
				$_SESSION['user'] = $row['St_id'];
				header("Location: home.php");
			}
		}
		elseif($selected_radio=='Admin') {
			$res=mysqli_query($conn,"SELECT admin_id,admin_name, admin_pass FROM admin WHERE admin_id='$email'");
			$row=mysqli_fetch_array($res);
			$count = mysqli_num_rows($res);
            if( $count == 1 && $row['admin_pass']==$password) {
				$_SESSION['user'] = $row['admin_id'];
				header("Location: admin/index.php");
			}
		}

			else {
				$errMSG = "Incorrect Credentials, Try again...";
			}

		}

	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Smart Locker</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" type="text/css" href="styles.css"/>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="container">
	<div class="Header">

			</div>

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

    	<div class="col-md-12">

        	<div class="form-group">
            	<h2 class="">Sign In.</h2>
            </div>

        	<div class="form-group">
            	<hr />
            </div>

            <?php
			if ( isset($errMSG) ) {

				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; echo $password?>
                </div>
            	</div>
                <?php
			}
			?>

            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"></span>
            	<input type="text" name="email" class="form-control" placeholder="Your ID" value="<?php echo $email; ?>" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>

            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
				 <form>
				 <input type="radio" name="users" value="User" id="r1" checked >
					<label for="r1"><span></span>User</label>
					<p>
					<input type="radio" name="users" id="r2" value="Admin">
					<label for="r2"><span></span>Admin</label>


				</form>
            </div>

            <div class="form-group">
            	<hr />
            </div>

            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>

        </div>

    </form>

    </div>

</div>
<div class="Footer"></div>

</body>
</html>
<?php ob_end_flush(); ?>
