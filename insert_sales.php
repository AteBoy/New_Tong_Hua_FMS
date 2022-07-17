<?php
    include("config.php");

    if($connection->connect_error){
        die("Connection FailedL ". $connection->connect_error);
    }
    $field_name = $_GET['id'];
    $field_id = strip_tags(trim($field_name));
    $split_data = explode(':', $field_id);

    $table = $split_data[0];
    $posting = $split_data[1];
    $id = $split_data[2];
    $tag;
    $key;
    if($table == "sales"){
        $tag = "SLS-";
        $key = "sales";
    }
        //Query for sales Entry ID
        $query_last_sales_entry_id = "SELECT
                                    $id
                                    FROM
                                    $table
                                    ORDER BY
                                    $id
                                    DESC
                                    LIMIT 1";

        $result_last_sales_entry_id = $connection->query($query_last_sales_entry_id);
        $row_count = mysqli_num_rows($result_last_sales_entry_id);

        if ($row_count == 0) {
            $new_sales_entry_id = "SLS-000001";
        }

        else{
            while ($row_last_sales_entry_id = $result_last_sales_entry_id->fetch_assoc()){
                $temp_sales_entry_id = $row_last_sales_entry_id["$id"];
                $get_num_sales_entry_id = str_replace("$tag", "", $temp_sales_entry_id);
                $increment_sales_entry_id = $get_num_sales_entry_id + 1;
                $string_sales_entry_id = str_pad($increment_sales_entry_id, 6,0, STR_PAD_LEFT);
                $new_sales_entry_id =  "$tag".$string_sales_entry_id;  
            }   
        }

        //Query for Posting ID
        $query_last_posting_id = "SELECT
                            $posting
                            FROM
                            $table
                            ORDER BY
                            $posting
                            DESC
                            LIMIT 1";

        $result_last_posting_id = $connection->query($query_last_posting_id);
        $row_count2 = mysqli_num_rows($result_last_posting_id);

        if ($row_count2 == 0) {
            $increment_posting_id= 1;
        }

        else {
            while ($row_last_posting_id = $result_last_posting_id->fetch_assoc()) {
                $temp_posting_id = $row_last_posting_id["$posting"];
                $get_num_posting_id = str_replace("PS-", "", $temp_posting_id);
                $increment_posting_id = $get_num_posting_id + 1;                          
            }
        }

        $current_date = date("Y-m-d");
 
        for ($i=0; $i < count($_POST['sales_acc']); $i++) { 
            $account_name = $_POST['sales_acc'][$i];
            $debit = $_POST['sales_debit'][$i];
            $credit = $_POST['sales_credit'][$i];
            $sales_buyer = $_POST['sales_buyer'];
            $sales_item = $_POST['sales_item'];
            $sales_price = $_POST['sales_price'];
            $sales_cat = $_POST['sales_cat'];
            $sales_quantity = $_POST['sales_quantity'];
            $total = $sales_quantity * $sales_price;
            $sales_entry_description = $_POST['sales_exp'];
            
            if($i == 0){
                $query_account_id_table = "SELECT
                account_name, account_id, account_type
                FROM
                account
                WHERE
                account_id = '$account_name'";

                $result_account_id_table = $connection->query($query_account_id_table);

                while ($row_account_id_table = $result_account_id_table->fetch_assoc()) {
                    $account_id = $row_account_id_table["account_id"];
                    $account_type = $row_account_id_table["account_type"];
                }

                if ($i == 0) {
                    $increment_posting_id = $increment_posting_id;
                    $string_posting_id = str_pad($increment_posting_id, 6,0, STR_PAD_LEFT);
                    $new_posting_id =  "PS-".$string_posting_id;
                }
                else {
                    $increment_posting_id = $increment_posting_id + 1;
                    $string_posting_id = str_pad($increment_posting_id, 6,0, STR_PAD_LEFT);
                    $new_posting_id =  "PS-".$string_posting_id;
                }

                //echo "<script>alert('$account_type');</script>";
                if ($debit > $credit) {
                    if ($account_type == "Asset" || $account_type == "Expenses") {
                        $query_insert_into_database = "INSERT INTO $table(sales_posting_id, account_id, sales_date, sales_entry_id, buyer_name, item_name, category, price, quantity, total, debit, credit, sales_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_sales_entry_id','$sales_buyer','$sales_item','$sales_cat','$sales_price','$sales_quantity','$total', '$debit', '$credit','$debit','$sales_entry_description')";
                    }
                    else if ($account_type == "Liability" || $account_type == "Owners Equity" || $account_type == "Income") {
                        $debit = $debit * -1;
                        $query_insert_into_database = "INSERT INTO $table(sales_posting_id, account_id, sales_date, sales_entry_id, buyer_name, item_name, category, price, quantity, total, debit, credit, sales_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_sales_entry_id','$sales_buyer','$sales_item','$sales_cat','$sales_price','$sales_quantity','$total', '$debit', '$credit','$debit','$sales_entry_description')";
                    }
                }

                else if ($debit < $credit) {
                    if ($account_type == "Asset" || $account_type == "Expenses") {
                        $credit = $credit * -1;
                        $query_insert_into_database = "INSERT INTO $table(sales_posting_id, account_id, sales_date, sales_entry_id, buyer_name, item_name, category, price, quantity, total, debit, credit, sales_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_sales_entry_id','$sales_buyer','$sales_item','$sales_cat','$sales_price','$sales_quantity','$total', '$debit', '$credit','$credit','$sales_entry_description')";
                    }
                    else if ($account_type == "Liability" || $account_type == "Owners Equity" || $account_type == "Income"){
                        $query_insert_into_database = "INSERT INTO $table(sales_posting_id, account_id, sales_date, sales_entry_id, buyer_name, item_name, category, price, quantity, total, debit, credit, sales_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_sales_entry_id','$sales_buyer','$sales_item','$sales_cat','$sales_price','$sales_quantity','$total', '$debit', '$credit','$credit','$sales_entry_description')";
                    }
                }
                $sql = "SELECT item_name.merchandise, item_category from $table, merchandise where item_name.sales = item_name.merchandise && item_category = category";
                $result = $connection->query($sql);
                //$new_stock = $inv_quantity + 
                $qry = "UPDATE merchandise SET item_stock = item_stock - '$sales_quantity' WHERE item_name = '$sales_item' && item_category = '$sales_cat'";
                $result = $connection->query($qry);

                $sql = "SELECT item_name, customer_name from customer where item_name = '$sales_item' && customer_name = '$sales_buyer'";
            $result = $connection->query($sql); 
            $row = $result->fetch_assoc();

            if($result){
                if(mysqli_num_rows($result) > 0){
                    
                    $qry = "UPDATE customer SET stock = stock + '$sales_quantity' WHERE item_name = '$sales_item' && customer_name = '$sales_buyer'";
                    $result = $connection->query($qry);

                }
                else{
                    $qry = "INSERT into customer(customer_id, customer_name, stock, item_name) value ('','$sales_buyer','$sales_quantity','$sales_item')";
                    $result = $connection->query($qry);
    
                }
            }
            $qry = "INSERT INTO stock(stock_id, stock_date, supplier_name, item_id, category, price, quantity, total, stock_status) VALUES('','$current_date','$sales_buyer',(select item_id from merchandise where item_name = '$sales_item' && item_category = '$sales_cat'),'$sales_cat','$sales_price','$sales_quantity','$total','out')";
            $result = $connection->query($qry);

            }
            else{
                $query_account_id_table = "SELECT
                account_name, account_id, account_type
                FROM
                account
                WHERE
                account_id = '$account_name'";

                $result_account_id_table = $connection->query($query_account_id_table);

                while ($row_account_id_table = $result_account_id_table->fetch_assoc()) {
                    $account_id = $row_account_id_table["account_id"];
                    $account_type = $row_account_id_table["account_type"];
                }

                if ($i == 0) {
                    $increment_posting_id = $increment_posting_id;
                    $string_posting_id = str_pad($increment_posting_id, 6,0, STR_PAD_LEFT);
                    $new_posting_id =  "PS-".$string_posting_id;
                }
                else {
                    $increment_posting_id = $increment_posting_id + 1;
                    $string_posting_id = str_pad($increment_posting_id, 6,0, STR_PAD_LEFT);
                    $new_posting_id =  "PS-".$string_posting_id;
                }

                //echo "<script>alert('$account_type');</script>";
                if ($debit > $credit) {
                    if ($account_type == "Asset" || $account_type == "Expenses") {
                        $query_insert_into_database = "INSERT INTO $table(sales_posting_id, account_id, sales_date, sales_entry_id, buyer_name, item_name, category, price, quantity, total, debit, credit, sales_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_sales_entry_id','$sales_buyer','0','0','0','0','0', '$debit', '$credit','$debit','$sales_entry_description')";
                    }
                    else if ($account_type == "Liability" || $account_type == "Owners Equity" || $account_type == "Income") {
                        $debit = $debit * -1;
                        $query_insert_into_database = "INSERT INTO $table(sales_posting_id, account_id, sales_date, sales_entry_id, buyer_name, item_name, category, price, quantity, total, debit, credit, sales_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_sales_entry_id','$sales_buyer','0','0','0','0','0', '$debit', '$credit','$debit','$sales')";
                    }
                }

                else if ($debit < $credit) {
                    if ($account_type == "Asset" || $account_type == "Expenses") {
                        $credit = $credit * -1;
                        $query_insert_into_database = "INSERT INTO $table(sales_posting_id, account_id, sales_date, sales_entry_id, buyer_name, item_name, category, price, quantity, total, debit, credit, sales_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_sales_entry_id','$sales_buyer','0','0','0','0','0','$total', '$debit', '$credit','$debit','$sales_entry_description')";
                    }
                    else if ($account_type == "Liability" || $account_type == "Owners Equity" || $account_type == "Income"){
                        $query_insert_into_database = "INSERT INTO $table(sales_posting_id, account_id, sales_date, sales_entry_id, buyer_name, item_name, category, price, quantity, total, debit, credit, sales_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_sales_entry_id','$sales_buyer','0','0','0','0','0','$total', '$debit', '$credit','$debit','$sales_entry_description')";
                    }
                }
            }
            
                
            $result_insert_into_database = $connection->query($query_insert_into_database);
        }
        
    $connection->close();
    header("Location: home.php");
?>