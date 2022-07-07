<?php include("config.php");
					
	session_start();
		if($connection->connect_error){
		die("Connection FailedL ". $connection->connect_error);
		}
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$error = "";
		if(isset($_POST['submit_login'])) {

			$user = $_POST['username'];
			$pass = $_POST['password']; 
		
			$_SESSION['attempt'] = 0;
			
	
			//check if there are 3 attempts already
			if($_SESSION['attempt'] == 3){
				$_SESSION['error'] = 'Attempt limit reach';
			}
			else{
				$sql = "SELECT admin_id, admin_role FROM admin WHERE admin_name = '$user' and admin_pass = '$pass'";
				$result = $connection->query($sql);
				$row = $result->fetch_assoc();
				$admin = $row["admin_id"];
				$role = $row["admin_role"];
				$count = mysqli_num_rows($result);
				
				if($count == 1) {
					$_SESSION['login_user'] = $user;
					$date = date("Y-m-d H:i:s a");
					$qry = "INSERT INTO logs (log_id, admin_id, login, logout) VALUES ('','$admin','$date','')";
					$result = $connection->query($qry);

					$sql = "SELECT log_id FROM logs order by log_id desc limit 1";
					$result = $connection->query($sql);
					$row = $result->fetch_assoc();
					$log_id = $row["log_id"];

					$_SESSION['log_id'] = $log_id;
					$_SESSION['role'] = $role;
					$attemp = 0;
					$connection->close(); 
					header("location: home.php");
				}else {
					$_SESSION['attempt'] += 1;
					$error = "Your Login UserName or Password is invalid";
					echo "<script>alert('$error');</script>";
					$attemp++;
					echo "<script>alert('$attemp');</script>";
				}
			}
			// https://www.sourcecodester.com/tutorials/php/12247/how-create-login-attempt-validation-using-php.html
		}
		
?>