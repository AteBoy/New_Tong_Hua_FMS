<!DOCTYPE html>
<?php
	session_start();
	//check if can login again
	if(isset($_SESSION['attempt_again'])){
		$now = time();
		if($now >= $_SESSION['attempt_again']){
			unset($_SESSION['attempt']);
			unset($_SESSION['attempt_again']);
		}
	}
 
?>
<html lang = "eng" dir = "ltr">

	<head>
		<meta charset = "utf-8">
		<title> New Legazpi Tong Hua Trading Login </title>
		 <link rel="stylesheet" href="style/login.css?t=<?php echo round(microtime(true)*1000);?>">	
	</head>
	
	<body>
		<div class="body-image"></div>

		<div class = "center">
			<h1> Welcome to Tong Hua Trading </h1>
			<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<div class="txt_field">
					<input type="text" name = "username"required>
					<span></span>
					<label>Username</label>
				</div>
        		<div class="txt_field">
        			<input type="password" name = "password" required>
        			<span></span>
        			<label>Password</label>
        		</div>
				<div class="pass" class = "btn" id = "reset_pass">Forgot Password?</div>
					<input type = "submit" value = Login name = "submit_login">
				</div>
		 	</form>
			 <div id="reset_modal" class="modal">

                    <div class="modal-content">
                      <div class="modal-header">
                        <span class="close" id = "close">&times;</span>
                        <h2>Add Account</h2>
                      </div>
                      <div class="modal-body">
                        <form action="" method = "post">
                            <div class="container">

                                <label for="admin_key"><b>Admin Key</b></label>
                                <input type="text" placeholder="Enter Admin Key" name="admin_key" id="admin_key" required>
                          
                                <label for="new_pass"><b>New Password</b></label>
								<input type="password" placeholder="Enter New Password" name="new_pass" id="new_pass" required>

                                <input type = "submit" class = "reset_btn" name = "submit_pass" value = "SUBMIT">
                            </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                      
                      </div>
                    </div>
                </div>
				<?php 
					if(isset($_POST['submit_pass'])){
						$admin_key = $_POST['admin_key'];
						$new_pass = $_POST['new_pass'];
						$qry = "UPDATE admin SET admin_pass = '$new_pass' WHERE admin_key = $admin_key";
            			$result = $connection->query($qry);
					}
				?>
            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
	</body>
	<?php
	include("config.php");
					
		if($connection->connect_error){
		die("Connection FailedL ". $connection->connect_error);
		}
		//clearstatcache();
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$error = "";
		if(isset($_POST['submit_login'])) {
			session_start();
			$user = $_POST['username'];
			$pass = $_POST['password']; 
			
			$ip = $_SERVER["REMOTE_ADDR"];
			
			$qry = "INSERT INTO ip (address,timestamp) VALUES ('$ip',CURRENT_TIMESTAMP)";
			$result = $connection->query($qry);
			$sql = "SELECT count(*) AS n FROM ip where address LIKE '$ip' AND timestamp > (now() - interval 10 minute)";
			$result = $connection->query($sql);
			$row = $result->fetch_assoc();
			$count = $row["n"];
			echo "<script>alert('$count');</script>";
			//$admin = $row["admin_id"];
			if(!isset($_SESSION['attempt'])){
				$_SESSION['attempt'] = 0;
			}
			if($count > 3){
				$_SESSION['error'] = 'Attempt limit reach';
				$err = $_SESSION['error'];
				echo "<script>alert('$err');</script>";
			}
			//check if there are 3 attempts already
			/*if($_SESSION['attempt'] == 3){
				$_SESSION['error'] = 'Attempt limit reach';
				$err = $_SESSION['error'];
				echo "<script>alert('$err');</script>";
			}*/
			else{
				$sql = "SELECT admin_id, admin_role FROM admin WHERE admin_name = '$user' and admin_pass = '$pass'";
				$result = $connection->query($sql);
				$row = $result->fetch_assoc();
				$admin = $row["admin_id"];
				$role = $row["admin_role"];
				$attempt_id;
				$count = mysqli_num_rows($result);
				
				if($count == 1) {
					$_SESSION['login_user'] = $user;
					$date = date("Y-m-d H:i:s a");
					$qry = "INSERT INTO logs (log_id, admin_id, login, logout) VALUES ('','$admin','$date','')";
					$result = $connection->query($qry);

					$sql = "SELECT log_id, admin_id FROM logs order by log_id desc limit 1";
					$result = $connection->query($sql);
					$row = $result->fetch_assoc();
					$log_id = $row["log_id"];

					$_SESSION['log_id'] = $log_id;
					
					$_SESSION['role'] = $role;
					$_SESSION['success'] = 'Login successful';
					//unset our attempt
					unset($_SESSION['attempt']);
					$connection->close(); 
					header("location: home.php");
				}
				if(($_SESSION['attempt']) == 0){
					//echo "<script>alert('$admin');</script>";
					$qry = "INSERT INTO login_attempt(attempt_id, attempt) VALUES('','1')";
					$result = $connection->query($qry);
					$_SESSION['attempt'] += 1;
					$sql = "SELECT attempt_id from login_attempt order by attempt_id desc limit 1";
					$result = $connection->query($sql); 
					$row = $result->fetch_assoc();
					$attempt_id = $row["attempt_id"]; //current problem
					
					$m = $_SESSION['attempt'];
					echo "<script>alert('$m');</script>";
				}
				else {
					$_SESSION['error'] = 'Password incorrect';
					//this is where we put our 3 attempt limit
					//$_SESSION['attempt'] += 1;
					echo "<script>alert('$attempt_id');</script>";

					$qry = "UPDATE login_attempt SET attempt = attempt + '1' where attempt_id = $attempt_id";
					$result = $connection->query($qry);
					$sql = "SELECT attempt from login_attempt where attempt_id = '$attempt_id'";
					$result = $connection->query($sql); 
					$row = $result->fetch_assoc();
					$temp = $row["attempt"];
					$_SESSION['attempt'] = $temp;
					$m = $_SESSION['attempt'];
					echo "<script>alert('$m');</script>";
					if($$_SESSION['attempt'] == 3){
						$_SESSION['attempt_again'] = time() + (5*60);
					}
				}
			}
			// https://www.sourcecodester.com/tutorials/php/12247/how-create-login-attempt-validation-using-php.html
		}
		if(isset($_GET['logout'])){
			$logout = $_GET['logout'];
			$date2 = date("Y-m-d H:i:s a");
			$sql = "UPDATE logs SET logout = '$date2' WHERE logout = $logout";
			$result = $connection->query($sql);
			header("Location: login_page.php");
		}
		?>
		<script>
			var modal = document.getElementById("reset_modal");
			var reset = document.getElementById("reset_pass");
			var span = document.getElementById("close");

			reset.onclick = function() {
				modal.style.display = "block";
			}
			span.onclick = function() {
				modal.style.display = "none";
			}
	</script>
</html>