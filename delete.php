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
    
    if($table == "inventory"){
      
        $sql = "SELECT item_name, category, quantity from inventory where inventory_entry_id = '$id' && quantity <> '0'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        $quantity = $row["quantity"];
        $item_name = $row['item_name'];
        $item_cat = $row['category'];

        //$qry = "UPDATE merchandise SET item_stock = item_stock - '$quantity' where item_name = '$item_name' && item_category = '$item_cat'";
        $qry = "UPDATE merchandise SET item_stock = item_stock - '$quantity' where item_name = '$item_name' && item_category = '$item_cat'";
        $result = $connection->query($qry);

    }
    $qry = "DELETE FROM $table WHERE $field = '$id'";
    $result = $connection->query($qry);
    $connection->close(); 
    header("Location: home.php");
?>