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
        $inv_debit = $_POST['inv_debit'];
        $inv_credit = $_POST['inv_credit'];
        $exp = $_POST['inv_exp'];
        $title;
        for ($i = 0; $i < count($inv_acc); $i++) {
            if (strlen($inv_acc[$i]) !== 0) {
                $acc = $inv_acc[$i];
                $debit = $inv_debit[$i];
                $credit = $inv_credit[$i];

                $qry = "INSERT INTO inventory(inventory_id, account_id, inv_date, supplier_id, item_name, category, price, quantity, total, journal, debit, credit, explanation) VALUES ('','$acc','$date',(SELECT supplier_id from supplier where supplier_name = '$inv_sup'),'$inv_item','$inv_cat','$inv_price','$inv_quantity','$total',(select account_type from account where account_id = '$acc'), '$debit', '$credit','$exp')";
                $result = $connection->query($qry);
            }
        }
        $sql = "SELECT item_name, item_category from merchandise where item_name = '$inv_item' && item_category = '$inv_cat'";
        $result = $connection->query($sql); 
        $row = $result->fetch_assoc();

        if($result){
            if(mysqli_num_rows($result) > 0){
                
                //$new_stock = $inv_quantity + 
                $qry = "UPDATE merchandise SET item_stock = item_stock + '$inv_quantity' WHERE item_name = '$inv_item' && item_category = '$inv_cat'";
                $result = $connection->query($qry);
 
            }
            else{
                $qry = "INSERT INTO merchandise(item_id, item_name, item_category, item_stock) VALUES('','$inv_item','$inv_cat','$inv_quantity')";
                $result = $connection->query($qry);
   
            }
        }
       
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
        $sales_debit = $_POST['sales_debit'];
        $sales_credit = $_POST['sales_credit'];
        $exp = $_POST['sales_exp'];

        
        $sql = "SELECT item_name, item_category from merchandise where item_name = '$sales_item' && item_category = '$sales_cat'";
        $result = $connection->query($sql); 
        $row = $result->fetch_assoc();

        if($result){
            if(mysqli_num_rows($result) > 0){

                for ($i = 0; $i < count($sales_acc); $i++) {
                    if (strlen($sales_acc[$i]) !== 0) {
                        $acc = $sales_acc[$i];
                        $debit = $sales_debit[$i];
                        $credit = $sales_credit[$i];
        
                        $qry = "INSERT INTO sales(sales_id, account_id, sales_date, buyer_name, item_name, category, price, quantity, total, journal, debit, credit, explanation) VALUES ('','$acc','$date','$sales_buyer','$sales_item','$sales_cat','$sales_price','$sales_quantity','$total',(select account_type from account where account_id = '$acc'), '$debit', '$credit','$exp')";
                        $result = $connection->query($qry);
                    }
                }

                $sql = "SELECT item_name.merchandise, item_category from inventory, merchandise where item_name.inventory = item_name.merchandise && item_category = category";
                $result = $connection->query($sql);
                //$new_stock = $inv_quantity + 
                $qry = "UPDATE merchandise SET item_stock = item_stock - '$sales_quantity' WHERE item_name = '$sales_item' && item_category = '$sales_cat'";
                $result = $connection->query($qry);
 
            }
            else{
                echo "<script>alert('Item Not Found, Please Try Again');</script>";
   
            }
        }
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
        
        $connection->close(); 
    }
    if(isset($_POST['submit_gen'])){
        $gen_acc = $_POST['gen_acc'];
        $gen_debit = $_POST['gen_debit'];
        $gen_credit = $_POST['gen_credit'];
        $date = date("Y/m/d");
        $exp = $_POST['gen_exp'];
        for ($i = 0; $i < count($gen_acc); $i++) {
            if (strlen($gen_acc[$i]) !== 0) {
                $acc = $gen_acc[$i];
                $debit = $gen_debit[$i];
                $credit = $gen_credit[$i];
 
                $qry = "INSERT INTO general(general_id, account_id, debit, credit, journal, date, explanation) VALUES ('','$acc','$debit','$credit',(select account_type from account where account_id = '$acc'),'$date','$exp')";
                $result = $connection->query($qry);
            }
        }
        
    }
    if(isset($_POST['submit_sup'])){
        $sup_name = $_POST['sup_name'];
        $sup_adr = $_POST['sup_adr'];
        $sup_no = $_POST['sup_no'];
        
        $qry = "INSERT INTO supplier(supplier_ID, supplier_name, address, contact) VALUES ('','$sup_name','$sup_adr','$sup_no')";
        
        $result = $connection->query($qry);
        $connection->close(); 
    }
    if(isset($_POST['submit_admin'])){
        $admin_name = $_POST['admin_name'];
        $admin_pass = $_POST['admin_pass'];
        $admin_no = $_POST['admin_no'];
        $admin_address = $_POST['admin_address'];
        $admin_role = $_POST['admin_role'];
        $admin_key = rand(100000,900000);
        $qry = "INSERT INTO admin(admin_id, admin_name, admin_pass, admin_contact, address, admin_key, admin_role) VALUES ('','$admin_name','$admin_pass','$admin_no','$admin_address','$admin_key','$admin_role')";
        
        $result = $connection->query($qry);
        $connection->close(); 
    }

header("Location: home.php");
?>