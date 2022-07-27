<?php
include("config.php");

if($connection->connect_error){
    die("Connection FailedL ". $connection->connect_error);
}

    $field_name = $_GET['table'];
    $field_id = strip_tags(trim($field_name));
    $split_data = explode(':', $field_id);

    $table = $split_data[0];
    $entry_id = $split_data[1];
    $posting_id = $split_data[2];
    $tag = $split_data[3];

    //Query for Inventory Entry ID
    $query_last_inventory_entry_id = "SELECT
    $entry_id
    FROM
    $table
    ORDER BY
    $entry_id
    DESC
    LIMIT 1";

$result_last_inventory_entry_id = $connection->query($query_last_inventory_entry_id);
$row_count = mysqli_num_rows($result_last_inventory_entry_id);
$test = 0;

if ($row_count == 0) {
    $new_inventory_entry_id = $tag."000001";
}

else{
while ($row_last_inventory_entry_id = $result_last_inventory_entry_id->fetch_assoc()){
    $temp_inventory_entry_id = $row_last_inventory_entry_id[$entry_id];
    $get_num_inventory_entry_id = str_replace($tag, "", $temp_inventory_entry_id);
    //echo "<script>alert('$temp_inventory_entry_id');</script>";
    $increment_inventory_entry_id = $get_num_inventory_entry_id + 1;
    $string_inventory_entry_id = str_pad($increment_inventory_entry_id, 6,0, STR_PAD_LEFT);
    $new_inventory_entry_id =  $tag.$string_inventory_entry_id;  
}   
}

//Query for Posting ID
$query_last_posting_id = "SELECT
$posting_id
FROM
$table
ORDER BY
$posting_id
DESC
LIMIT 1";

$result_last_posting_id = $connection->query($query_last_posting_id);
$row_count2 = mysqli_num_rows($result_last_posting_id);

if ($row_count2 == 0) {
    $increment_posting_id= 1;
}

else {
while ($row_last_posting_id = $result_last_posting_id->fetch_assoc()) {
    $temp_posting_id = $row_last_posting_id[$posting_id];
    $get_num_posting_id = str_replace("PS-", "", $temp_posting_id);
    $increment_posting_id = $get_num_posting_id + 1;                          
}
}

session_start();
$tag_entry = $table.'_entry';
$tag_posting = $table.'_posting';
echo "<script>alert('$new_inventory_entry_id');</script>";
$_SESSION[$tag_entry] = $new_inventory_entry_id;
$_SESSION[$tag_posting] = $increment_posting_id;

?>