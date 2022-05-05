<?php
include("config.php");

if($connection->connect_error){
    die("Connection FailedL ". $connection->connect_error);
}
if(!empty($_POST))
{
    //database settings

    foreach($_POST as $field_name => $val)
    {
        //clean post values
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
            
            $qry = "UPDATE $table SET $field = '$val' WHERE $id_name = $id";
            $result = $connection->query($qry);

            /*if($field == "price" || $field == "quantity"){
                $sql = "SELECT $field from quantity where $id_name = 'id'";
                $result = $connection->query($sql);
                $row = $result->fetch_assoc();
                $quantity = $row["quantity"];
                $qry = "UPDATE $table SET total = '$val * $quantity' WHERE $id_name = $id";
                $result = $connection->query($qry);
            }*/
            echo "Updated";
        } else {
            echo "Invalid Requests";
        }
    }
} 

else {
    echo "Invalid Requests";
}
$connection->close(); 
?>