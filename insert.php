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
function val($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
}
header("Location: home.php");
?>