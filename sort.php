<?php
include("config.php");

if($connection->connect_error){
    die("Connection FailedL ". $connection->connect_error);
}
echo "<script>alert('yes');</script>";
if(!empty($_POST))
{
    //database settings

    $field_name = $_POST['field'];
    
        //clean post values
        echo "<script>alert('yes');</script>";
        $field_id = strip_tags(trim($field_name));

        //from the fieldname:user_id we need to get user_id
        $split_data = explode(':', $field_id);
 
        $table = $split_data[0];
        $field = $split_data[1];
        $id_name = $split_data[2];
        $id = $split_data[3];
        //$product_id = $split_data[2];
        
        if(!empty($field) && !empty($table) && !empty($val))
        {
            
            $qry = "SELECT * from $table ORDER BY $field DESC";
            $result = $connection->query($qry);

            echo "Sorted";
        } else {
            echo "Invalid Requests";
        }
    
} 

else {
    echo "Invalid Requests";
}
$connection->close(); 
?>