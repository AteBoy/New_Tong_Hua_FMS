<?php


   include('config.php');
   session_start();

   if($connection->connect_error){
       die("Connection FailedL ". $connection->connect_error);
    }

        $user = $_SESSION['login_user'];
        $sql = "SELECT admin_id FROM admin_name WHERE admin_name = '$user'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        $login_session = $row['admin_name'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>