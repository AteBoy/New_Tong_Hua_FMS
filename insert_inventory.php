<?php
    include("config.php");

    if($connection->connect_error){
        die("Connection FailedL ". $connection->connect_error);
    }
    header("Location: format.php?table=inventory:inventory_entry_id:inventory_posting_id:INV-");
   
    session_start();
    $new_inventory_entry_id = $_SESSION['inventory_entry'];
    $increment_posting_id = $_SESSION['inventory_posting'];
  
        $current_date = date("Y-m-d");
 
        for ($i=0; $i < count($_POST['inv_acc']); $i++) { 
            $account_name = $_POST['inv_acc'][$i];
            $debit = $_POST['inv_debit'][$i];
            $credit = $_POST['inv_credit'][$i];
            $inv_sup = $_POST['inv_sup'];
            $inv_item = $_POST['inv_item'];
            $inv_price = $_POST['inv_price'];
            $inv_cat = $_POST['inv_cat'];
            $inv_type = $_POST['inv_type'];
            $inv_measure = $_POST['inv_measure'];
            $inv_quantity = $_POST['inv_quantity'];
            $total = $inv_quantity * $inv_price;
            $inventory_entry_description = $_POST['inv_exp'];
            
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
                        $query_insert_into_database = "INSERT INTO inventory(inventory_posting_id, account_id, inv_date, inventory_entry_id, supplier_id, item_name, category, inv_measurement_type, inv_measurement, price, quantity, total, inv_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_inventory_entry_id',(SELECT supplier_id from supplier where supplier_name = '$inv_sup'),'$inv_item','$inv_cat','$inv_type','$inv_measure','$inv_price','$inv_quantity','$total','$debit','$inventory_entry_description')";
                    }
                    else if ($account_type == "Liability" || $account_type == "Owners Equity" || $account_type == "Income") {
                        $debit = $debit * -1;
                        $query_insert_into_database = "INSERT INTO inventory(inventory_posting_id, account_id, inv_date, inventory_entry_id, supplier_id, item_name, category, inv_measurement_type, inv_measurement, price, quantity, total, inv_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_inventory_entry_id',(SELECT supplier_id from supplier where supplier_name = '$inv_sup'),'$inv_item','$inv_cat','$inv_type','$inv_measure','$inv_price','$inv_quantity','$total','$debit','$inventory_entry_description')";
                    }
                }

                else if ($debit < $credit) {
                    if ($account_type == "Asset" || $account_type == "Expenses") {
                        $credit = $credit * -1;
                        $query_insert_into_database = "INSERT INTO inventory(inventory_posting_id, account_id, inv_date, inventory_entry_id, supplier_id, item_name, category, inv_measurement_type, inv_measurement, price, quantity, total, inv_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_inventory_entry_id',(SELECT supplier_id from supplier where supplier_name = '$inv_sup'),'$inv_item','$inv_cat','$inv_type','$inv_measure','$inv_price','$inv_quantity','$total','$credit','$inventory_entry_description')";
                    }
                    else if ($account_type == "Liability" || $account_type == "Owners Equity" || $account_type == "Income"){
                        $query_insert_into_database = "INSERT INTO inventory(inventory_posting_id, account_id, inv_date, inventory_entry_id, supplier_id, item_name, category, inv_measurement_type, inv_measurement, price, quantity, total, inv_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_inventory_entry_id',(SELECT supplier_id from supplier where supplier_name = '$inv_sup'),'$inv_item','$inv_cat','$inv_type','$inv_measure'.'$inv_price','$inv_quantity','$total','$credit','$inventory_entry_description')";
                    }
                }
                $sql = "SELECT item_name, item_category from merchandise where item_name = '$inv_item' && item_category = '$inv_cat'";
                $result = $connection->query($sql); 
                $row = $result->fetch_assoc();

                if($result){
                    if(mysqli_num_rows($result) > 0){
                        
                        //$new_stock = $inv_quantity + 
                        $qry_merch = "UPDATE merchandise SET item_stock = item_stock + '$inv_quantity' WHERE item_name = '$inv_item' && item_category = '$inv_cat'";
                        $result = $connection->query($qry_merch);
         
                    }
                    else{
                        $qry_merch = "INSERT INTO merchandise(item_id, item_name, item_category, item_stock) VALUES('','$inv_item','$inv_cat','$inv_quantity')";
                        $result = $connection->query($qry_merch);
           
                    }
                }
                $qry_stock = "INSERT INTO stock(stock_id, stock_date, supplier_name, item_id, category, price, quantity, total, stock_status) VALUES('','$current_date','$inv_sup',(select item_id from merchandise where item_name = '$inv_item' && item_category = '$inv_cat'),'$inv_cat','$inv_price','$inv_quantity','$total','in')";
                $result = $connection->query($qry_stock);

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
                        $query_insert_into_database = "INSERT INTO inventory(inventory_posting_id, account_id, inv_date, inventory_entry_id, supplier_id, item_name, category, price, quantity, total, inv_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_inventory_entry_id',(SELECT supplier_id from supplier where supplier_name = '$inv_sup'),'0','0','0','0','0','$debit','$inventory_entry_description')";
                    }
                    else if ($account_type == "Liability" || $account_type == "Owners Equity" || $account_type == "Income") {
                        $debit = $debit * -1;
                        $query_insert_into_database = "INSERT INTO inventory(inventory_posting_id, account_id, inv_date, inventory_entry_id, supplier_id, item_name, category, price, quantity, total, inv_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_inventory_entry_id',(SELECT supplier_id from supplier where supplier_name = '$inv_sup'),'0','0','0','0','0','$debit','$inventory_entry_description')";
                    }
                }

                else if ($debit < $credit) {
                   
                    if ($account_type == "Asset" || $account_type == "Expenses") {
                        $credit = $credit * -1;
                        $query_insert_into_database = "INSERT INTO inventory(inventory_posting_id, account_id, inv_date, inventory_entry_id, supplier_id, item_name, category, price, quantity, total, inv_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_inventory_entry_id',(SELECT supplier_id from supplier where supplier_name = '$inv_sup'),'0','0','0','0','0','$credit','$inventory_entry_description')";
                    }
                    else if ($account_type == "Liability" || $account_type == "Owners Equity" || $account_type == "Income"){
                        $query_insert_into_database = "INSERT INTO inventory(inventory_posting_id, account_id, inv_date, inventory_entry_id, supplier_id, item_name, category, price, quantity, total, inv_amount,explanation) VALUES ('$new_posting_id','$account_id','$current_date','$new_inventory_entry_id',(SELECT supplier_id from supplier where supplier_name = '$inv_sup'),'0','0','0','0','0','$credit','$inventory_entry_description')";
                    }
                }
            }
            
                
            $result_insert_into_database = $connection->query($query_insert_into_database);
        }

    $connection->close();
    
    header("Location: home.php");
?>