<?php
    include("config.php");

    if($connection->connect_error){
        die("Connection FailedL ". $connection->connect_error);
    }

    $id = $_GET['id']; 
    $table = $_GET['table'];

    if($table == "account"){
        $qry = "DELETE FROM $table WHERE account_id = '$id'";
        $result = $connection->query($qry);

        $connection->close(); 
        header("Location: home.php");
    }

    if($table == "inventory"){
        $qry = "DELETE FROM $table WHERE inventory_id = '$id'";
        $result = $connection->query($qry);

        $connection->close(); 
        header("Location: home.php");
    }
    if($table == "sales"){
        $qry = "DELETE FROM $table WHERE sales_id = '$id'";
        $result = $connection->query($qry);

        $connection->close(); 
        header("Location: home.php");
    }
    if($table == "supplier"){
        $qry = "DELETE FROM $table WHERE supplier_ID = '$id'";
        $result = $connection->query($qry);

        $connection->close(); 
        header("Location: home.php");
    }
?>