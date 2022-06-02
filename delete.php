<?php
    include("config.php");

    if($connection->connect_error){
        die("Connection FailedL ". $connection->connect_error);
    }

    $id = $_GET['id']; 
    $field_name = $_GET['table'];
    $field_id = strip_tags(trim($field_name));
    $split_data = explode(':', $field_id);

    $table = $split_data[0];
    $field = $split_data[1];

    $qry = "DELETE FROM $table WHERE $field = '$id'";
    $result = $connection->query($qry);
    echo "<script>alert('$id');</script>";
    $connection->close(); 
    header("Location: home.php");
?>