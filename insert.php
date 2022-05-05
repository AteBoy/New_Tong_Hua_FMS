<?php
    include("config.php");

    if($connection->connect_error){
        die("Connection FailedL ". $connection->connect_error);
    }

    if(isset($_POST['submit_acc'])){
        $acc_name = $_POST['acc_name'];
        $acc_type = $_POST['acc_type'];

        $sql = "SELECT account_id FROM account where account_type = '$acc_type' order by account_id desc limit 1";
        $result = $connection->query($sql);
        if($acc_type === "Asset"){

            if(!$result){
                die("Invalid Query: ". $connection_error);
            }

            $row = $result->fetch_assoc();

            if(!$row){
                $id = 1000;
                $qry = "INSERT INTO account(account_id, account_name, account_type) VALUES('$id','$acc_name','$acc_type')";
                $result = $connection->query($qry);
            }
            else{
                $id = $row["account_id"] + 1;
                $qry = "INSERT INTO account(account_id, account_name, account_type) VALUES('$id','$acc_name','$acc_type')";
                $result = $connection->query($qry);
            }
            
        }

        if($acc_type === "Liability"){

            if(!$result){
                die("Invalid Query: ". $connection_error);
            }

            $row = $result->fetch_assoc();
            
            if(!$row){
                $id = 2000;
                $qry = "INSERT INTO account(account_id, account_name, account_type) VALUES('$id','$acc_name','$acc_type')";
                $result = $connection->query($qry);
            }
            else{
                $id = $row["account_id"] + 1;
                $qry = "INSERT INTO account(account_id, account_name, account_type) VALUES('$id','$acc_name','$acc_type')";
                $result = $connection->query($qry);
            }
            
        }
        if($acc_type === "Owners Equity"){

            if(!$result){
                die("Invalid Query: ". $connection_error);
            }

            $row = $result->fetch_assoc();
            
            if(!$row){
                $id = 3000;
                $qry = "INSERT INTO account(account_id, account_name, account_type) VALUES('$id','$acc_name','$acc_type')";
                $result = $connection->query($qry);
            }
            else{
                $id = $row["account_id"] + 1;
                $qry = "INSERT INTO account(account_id, account_name, account_type) VALUES('$id','$acc_name','$acc_type')";
                $result = $connection->query($qry);
            }
        }
        if($acc_type === "Income"){


            if(!$result){
                die("Invalid Query: ". $connection_error);
            }

            $row = $result->fetch_assoc();
            
            if(!$row){
                $id = 4000;
                $qry = "INSERT INTO account(account_id, account_name, account_type) VALUES('$id','$acc_name','$acc_type')";
                $result = $connection->query($qry);
            }
            else{
                $id = $row["account_id"] + 1;
                $qry = "INSERT INTO account(account_id, account_name, account_type) VALUES('$id','$acc_name','$acc_type')";
                $result = $connection->query($qry);
            }
            
        }
        if($acc_type === "Expenses"){

            if(!$result){
                die("Invalid Query: ". $connection_error);
            }

            $row = $result->fetch_assoc();
            
            if(!$row){
                $id = 5000;
                $qry = "INSERT INTO account(account_id, account_name, account_type) VALUES('$id','$acc_name','$acc_type')";
                $result = $connection->query($qry);
            }
            else{
                $id = $row["account_id"] + 1;
                $qry = "INSERT INTO account(account_id, account_name, account_type) VALUES('$id','$acc_name','$acc_type')";
                $result = $connection->query($qry);
            }
            $connection->close();
            
        }
        $connection->close(); 
    }
    if(isset($_POST['submit_inv'])){
        $inv_acc = $_POST['inv_acc'];
        $inv_sup = $_POST['inv_sup'];
        $inv_item = $_POST['inv_item'];
        $inv_price = $_POST['inv_price'];
        $inv_cat = $_POST['inv_cat'];
        $inv_quantity = $_POST['inv_quantity'];
        $date = date("Y/m/d");
        $total = $inv_quantity * $inv_price;
        $debit = $_POST['inv_debit'];
        $credit = $_POST['inv_credit'];
        $exp = $_POST['inv_exp'];

        $qry = "INSERT INTO inventory(inventory_id, account_id, inv_date, supplier_id, item_name, category, price, quantity, total, journal, debit, credit, explanation) VALUES ('','$inv_acc','$date',(SELECT supplier_id from supplier where supplier_name = '$inv_sup'),'$inv_item','$inv_cat','$inv_price','$inv_quantity','$total',(select account_type from account where account_id = '$inv_acc'), '$debit', '$credit','$exp')";
        $result = $connection->query($qry);
        $connection->close(); 
    }
    if(isset($_POST['submit_sales'])){
        $sales_acc = $_POST['sales_acc'];
        $sales_buyer = $_POST['sales_buyer'];
        $sales_item = $_POST['sales_item'];
        $sales_price = $_POST['sales_price'];
        $sales_cat = $_POST['sales_cat'];
        $sales_quantity = $_POST['sales_quantity'];
        $date = date("Y/m/d");
        $total = $sales_quantity * $sales_price;
        $debit = $_POST['sales_debit'];
        $credit = $_POST['sales_credit'];
        $exp = $_POST['sales_exp'];

        $qry = "INSERT INTO sales(sales_id, account_id, sales_date, buyer_name, item_name, category, price, quantity, total, journal, debit, credit, explanation) VALUES ('','$sales_acc','$date','$sales_buyer','$sales_item','$sales_cat','$sales_price','$sales_quantity','$total',(select account_type from account where account_id = '$sales_acc'), '$debit', '$credit','$exp')";
        $result = $connection->query($qry);
        
        $qry = "INSERT INTO customer(customer_id, customer_name, stock) VALUES ('','$sales_buyer','$sales_quantity')";
        $result = $connection->query($qry);

        $connection->close(); 
    }
    if(isset($_POST['submit_gen'])){
        $gen_acc = $_POST['gen_acc'];
        $debit = $_POST['gen_debit'];
        $credit = $_POST['gen_credit'];
        $date = date("Y/m/d");
        $qry = "INSERT INTO general(general_id, account_id, debit, credit, journal, date) VALUES ('','$gen_acc','$debit','$credit',(select account_type from account where account_id = '$gen_acc'),'$date')";
        $result = $connection->query($qry);
    }
    if(isset($_POST['submit_sup'])){
        $sup_name = $_POST['sup_name'];
        $sup_adr = $_POST['sup_adr'];
        $sup_no = $_POST['sup_no'];
        
        $qry = "INSERT INTO supplier(supplier_ID, supplier_name, address, contact) VALUES ('','$sup_name','$sup_adr','$sup_no')";
        
        $result = $connection->query($qry);
        $connection->close(); 
    }

header("Location: home.php");
?>