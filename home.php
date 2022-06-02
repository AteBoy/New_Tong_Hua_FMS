<html>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
        <link rel= "stylesheet" type= "text/css" href= "style/style.css?t=<?php echo round(microtime(true)*1000);?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
        <title>Home</title>
    </head>
    <body>

        <div class = "header">
        
            <div id = "status"><button onclick= "open_menu()" class = "userMenu"> <?php 
                session_start();
                $login_user = $_SESSION['login_user'];
                $log_id = $_SESSION['log_id'];
                $role = $_SESSION['role'];
                if(empty($login_user)){
                    header("Location: login_page.php");
                }
                echo $login_user;
            ?>
            </button>
                <div id="myDropdown" class="user_dropdown">
                    <a href="home.php">Home</a>
                    <a href="login_page.php?logout=<?php echo $log_id?>">Logout</a>
                </div>
            </div>
        </div>
        <aside class = "nav">
            <ul>
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Dashboard')"><span class='icon-field'><i class="fa fa-home"></i></span> Dashboard</a></li> 
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Accounts')"><span class='icon-field'><i class="fa fa-users"></i></span> Accounts</a></li>
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Journal')"><span class='icon-field'><i class="fa fa-plus-square"></i></span> Journal Entry</a></li>
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Payable')"><span class='icon-field'><i class="fa fa-money"></i></span> Payable</a></li>
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Receivable')"><span class='icon-field'><i class="fa fa-reply"></i></span> Receivable</a></li>  
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Inventory')"><span class='icon-field'><i class="fa fa-shopping-basket"></i></span> Inventory</a></li> 
                <li><a href = "##" id = "admin_1" class = "tablink" onclick = "openTab(event, 'Financial_s')"><span class='icon-field'><i class="fa fa-newspaper-o"></i></span> Financial Statement</a></li>      
                <li><a href = "##" id = "admin_2" class = "tablink" onclick = "openTab(event, 'Logs')">Logs</a></li>
                <li><a href = "##" id = "admin_3" class = "tablink" onclick = "openTab(event, 'Admin')">Admin</a></li>    
            </ul>
        </aside>
        <div class = "content">
            <div id = "Dashboard" class = "tabContent">
                <div class = "contentNav">
                    <h4 id = "navHeader">Dashboard</h4>
                    <p class = "date">hello</p>
                </div>
        
                <div class = "box_tb" style="background-color: deepskyblue;">
                    <div class = "box_info">
                        <h4 id = "number">0</h4>
                        <h4 id = "label">Sales for the Month</h4>
                    </div>
                    <div class = "tb_bottom">
                        
                    </div>
                </div>
                <div class = "box_tb" style="background-color: limegreen;">
                    <div class = "box_info">
                        <h4 id = "number">0</h4>
                        <h4 id = "label">Sales for Last Month</h4>
                    </div>
                    <div class = "tb_bottom">
                        
                    </div>
                </div>
                <div class = "box_tb" style="background-color: royalblue;">
                    <div class = "box_info">
                        <h4 id = "number">0</h4>
                        <h4 id = "label">Sales For the Day</h4>
                    </div>
                    <div class = "tb_bottom">
                        
                    </div>
                </div>
                <div class = "box_tb" style="background-color: indianred;">
                    <div class = "box_info">
                        <h4 id = "number">0</h4>
                        <h4 id = "label">Total Daily Profit</h4>
                    </div>
                    <div class = "tb_bottom">
                        
                    </div>
                </div>
        
            </div>
            <div id = "Accounts" class = "tabContent">
                <div class = "contentNav">
                    <h4 id = "navHeader">Accounts</h4>
                    <p class = "date">hello</p>
                </div>   
                <div class = "account_frame" style="overflow-x:auto; overflow-x:auto;">
                    <input type="text" id = "acc_search" placeholder="Search" >
                    <table id = "acc_table">
                        <tr>
                            <th>Account Number <i class = "fa fa-sort" onclick="sortTable(0,'acc_table')"></i> </th>
                            <th>Account Name <i class = "fa fa-sort" onclick="sortTable(1,'acc_table')"></i></th>
                            <th>Account Type <i class = "fa fa-sort" onclick="sortTable(2,'acc_table')"></i></th>
                            <th>Action</th>
                        </tr>
                        <?php
                            include("config.php");
                            if($connection->connect_error){
                                die("Connection Failed ". $connection->connect_error);
                            }

                            $sql = "SELECT * FROM account";
                            $result = $connection->query($sql);

                            if(!$result){
                                die("Invalid Query: ". $connection_error);
                            }

                            while($row = $result->fetch_assoc()){
                                echo "<tbody data-link='row' class='rowlink'>
                                <tr>
                                    <td>" . $row["account_id"] . "</td>
                                    <td contenteditable='true' id = 'account:account_name:account_id:". $row["account_id"] ."'>" . $row["account_name"] . "</td>
                                    <td contenteditable='true' id = 'account:account_type:account_id:". $row["account_id"] ."'>" . $row["account_type"] . "</td>
                                    ";$id = $row["account_id"];?>
                                    
                                    <td><a href="delete.php?id=<?php echo $id;?>&table=account:account_id">Delete</i></a></td>
                               </tr><?php
                           }
                           $connection->close();?>
                       </table>
                </div>
                <button class = "btn" id = "add_acc">Add Account</button>
                <div id="create_acc_modal" class="modal">

                    <div class="modal-content">
                      <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Add Account</h2>
                      </div>
                      <div class="modal-body">
                        <form action="insert.php" method = "post">
                            <div class="container">

                                <label for="acc_name"><b>Account Name</b></label>
                                <input type="text" placeholder="Enter Account Name" name="acc_name" id="acc_name" required>
                          
                                <label for="acc_type"><b>Account Type</b></label>
                                <select name="acc_type" required>
                                    <option value="Asset">Asset</option>
                                    <option value="Liability">Liability</option>
                                    <option value="Owners Equity">Owners Equity</option>
                                    <option value="Income">Income</option>
                                    <option value="Expenses">Expenses</option>
                                </select>

                                <input type = "submit" class = "registerbtn" name = "submit_acc" value = "SUBMIT">
                            </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                      
                      </div>
                    </div>
                  
                </div>
            </div>
            <div id = "Journal" class = "tabContent">
                <div class = "contentNav">
                    <h4 id = "navHeader">Journal Entry</h4>
                    <p class = "date">hello</p>
                </div> 
                <div class = "journal_frame">
                    <div class = "journal_buttons">
                        <button class = "buttonLink" onclick="openTable(event, 'journal')">Journal Entry</button>
                        <button class = "buttonLink" onclick="openTable(event, 'sale_j')">Sales Journal</button>
                        <button class = "buttonLink" onclick="openTable(event, 'inv_j')">Inventory Journal</button>
                        <button class = "buttonLink" onclick="openTable(event, 'gen_j')">General Journal</button>
                    </div>
                    <div class = "tab_tb" id = "journal">
                        <table id = "journal_table">
                            <tr>
                                <th>Date <i class = "fa fa-sort" onclick="sortTable(0,'journal_table')"></i></th>
                                <th>Account Title and Explanation <i class = "fa fa-sort" onclick="sortTable(1,'journal_table')"></i></th>
                                <th>Journal Entry ID <i class = "fa fa-sort" onclick="sortTable(2,'journal_table')"></i></th>
                                <th>Journal <i class = "fa fa-sort" onclick="sortTable(3,'journal_table')"></i></th>
                                <th>Debit <i class = "fa fa-sort" onclick="sortTable(4,'journal_table')"></i></th>
                                <th>Credit <i class = "fa fa-sort" onclick="sortTable(5,'journal_table')"></i></th>
                                <th>Action</th>
                            </tr>
                            <tr>
                               
                            </tr>
                        </table>
        
                    </div>
                    <div class = "tab_tb" id = "sale_j" style="overflow-x:auto;">
                        <button class = "btn" id = "add_sales">New Entry</button>
                        <table id = "sales_table">
                            <tr>
                                <th>Sale ID <i class = "fa fa-sort" onclick="sortTable(0,'sales_table')"></i></th>
                                <th>Date <i class = "fa fa-sort" onclick="sortTable(1,'sales_table')"></i></th>
                                <th>Buyer Name <i class = "fa fa-sort" onclick="sortTable(2,'sales_table')"></i></th>
                                <th>Item Name <i class = "fa fa-sort" onclick="sortTable(3,'sales_table')"></i></th>
                                <th>Category <i class = "fa fa-sort" onclick="sortTable(4,'sales_table')"></i></th>
                                <th>Price <i class = "fa fa-sort" onclick="sortTable(5,'sales_table')"></i></th>
                                <th>Quantity <i class = "fa fa-sort" onclick="sortTable(6,'sales_table')"></i></th>
                                <th>Total Amount <i class = "fa fa-sort" onclick="sortTable(7,'sales_table')"></i></th>
                                <th>Journal <i class = "fa fa-sort" onclick="sortTable(8,'sales_table')"></i></th>
                                <th>Debit <i class = "fa fa-sort" onclick="sortTable(9,'sales_table')"></i></th>
                                <th>Credit <i class = "fa fa-sort" onclick="sortTable(10,'sales_table')"></i></th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $server = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "financial_db";
                        
                            $connection = new mysqli($server, $user, $pass, $db);
                        
                            if($connection->connect_error){
                                die("Connection Failed ". $connection->connect_error);
                            }

                            $sql = "SELECT * FROM sales";
                            $result = $connection->query($sql);

                            if(!$result){
                                die("Invalid Query: ". $connection_error);
                            }

                            while($row = $result->fetch_assoc()){
                                echo "<tr>
                                    
                                    <td>" . $row["sales_id"] . "</td>
                                    <td>" . $row["sales_date"] . "</td>
                                    <td contenteditable='true' id = 'sales:buyer_name:sales_id:". $row["sales_id"] ."'>" . $row["buyer_name"] . "</td>
                                    <td contenteditable='true' id = 'sales:item_name:sales_id:". $row["sales_id"] ."'>" . $row["item_name"] . "</td>
                                    <td contenteditable='true' id = 'sales:category:sales_id:". $row["sales_id"] ."'>" . $row["category"] . "</td>
                                    <td contenteditable='true' id = 'sales:price:sales_id:". $row["sales_id"] ."'>" . $row["price"] . "</td>
                                    <td  contenteditable='true' id = 'sales:quantity:sales_id:". $row["sales_id"] ."'>" . $row["quantity"] . "</td>
                                    <td>" . $row["total"] . "</td>
                                    <td  contenteditable='true' id = 'sales:journal:sales_id:". $row["sales_id"] ."'>" . $row["journal"] . "</td>
                                    <td>" . $row["debit"] . "</td>
                                    <td>" . $row["credit"] . "</td>
                                    ";$id = $row["sales_id"];?>
                                    
                                    <td><a href="delete.php?id=<?php echo $id;?>&table=sales:sales_id">Delete</i></a></td>
                               </tr><?php
                           }
                           $connection->close();?>
                       </table>
                    </div>
                    <div id="add_sales_modal" class="modal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="close" id = "close_sales">&times;</span>
                                <h2>Sales Entry</h2>
                            </div>
                            <div class="modal-body">
                                <form action="insert.php" method = "post">
                                    <div class="container">
                                        <button type = "button" class = "add_sales_acc">Add</button>
                                        <button type = "button" class="remove_sales_acc">remove</button>
                                        <div id = "new_ch3">
                                            <div style="float:left;margin-right:20px;width: 50%;">
                                                <label for="sales_acc"><b>Account ID</b></label>
                                                <select name="sales_acc[]" required>
                                                <option id = "total_ch3" value = "1">Account</option>
                                                <?php
                                                    include("config.php");
                                                    if($connection->connect_error){
                                                        die("Connection Failed ". $connection->connect_error);
                                                    }

                                                    $sql = "SELECT account_id, account_name FROM account";
                                                    $result = $connection->query($sql);

                                                    if(!$result){
                                                        die("Invalid Query: ". $connection_error);
                                                    }

                                                    while($row = $result->fetch_assoc()){
                                                        echo "
                                                    <option value=".$row["account_id"].">".$row["account_name"]."</option>
                                                    ";
                                                    }
                                                    $connection->close();
                                                ?>
                                                </select>
                                            </div>
                                            <div style="float:right;width: 22%;">
                                                <label for="sales_debit">Debit</label>
                                                <input type="number" id="sales_debit" name="sales_debit[]" required>
                                            </div>
                                            <div style="float:right;margin-right:20px;width: 22%;">
                                                <label for="sales_credit">Credit</label>
                                                <input type="number" id="sales_credit" name="sales_credit[]" required>
                                            </div>
                                        </div>
                                        <div style="float:left;;width: 100%;">
                                            <label for="sales_exp"><b>Explanation</b></label>
                                            <input type="text" placeholder="Enter Explanation" name="sales_exp" id="sales_exp" required>      
                                        </div>

                                        <div style="float:left;margin-right:20px;width: 60%;">
                                            <label for="sales_item"><b>Item Name</b></label>
                                            <input type="text" placeholder="Enter Item Name" name="sales_item" id="sales_item" required>      
                                        </div>

                                        <div style="float:right;width: 35%;">
                                            <label for="sales_cat"><b>Category</b></label>
                                            <input type="text" placeholder="Enter Category" name="sales_cat" id="sales_cat" required>   
                                        </div>

                                        <div style="float:left;margin-right:20px;width: 25%;">
                                            <label for="sales_buyer"><b>Buyer Name</b></label>
                                            <input type="text" placeholder="Enter Buyer Name" name="sales_buyer" id="sales_buyer" required>                       
                                        </div>

                                        <div style="float:right;width: 22%;">
                                            <label for="sales_total"><b>Total</b></label>
                                            <input type="number" placeholder="Total" name="sales_total" id="sales_total" required readonly>      
                                        </div>

                                        <div style="float:right;margin-right:20px;width: 22%;">
                                            <label for="sales_price"><b>Price</b></label>
                                            <input type="number" placeholder="Enter Price" name="sales_price" id="sales_price" onchange = "computeTotal('sales')"required>      
                                        </div>

                                        <div style="float:right;margin-right:20px;width: 22%;">
                                            <label for="sales_quantity"><b>Quantity</b></label>
                                            <input type="number" placeholder="Enter Quantity" name="sales_quantity" id="sales_quantity" required>     
                                        </div>

                                        <button type="submit" class="registerbtn" name="submit_sales">Register</button>    
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                    </div>
                    <div class = "tab_tb" id = "inv_j"style="overflow-x:auto;">
                        <button class = "btn" id = "add_inv">New Entry</button>
                        <table id = "inv_table">
                            <tr>
                                <th>Inventory ID <i class = "fa fa-sort" onclick="sortTable(0,'inv_table')"></i></th>
                                <th>Date <i class = "fa fa-sort" onclick="sortTable(1,'inv_table')"></i></th>
                                <th>Supplier Name <i class = "fa fa-sort" onclick="sortTable(2,'inv_table')"></i></th>
                                <th>Item Name <i class = "fa fa-sort" onclick="sortTable(3,'inv_table')"></i></th>
                                <th>Category <i class = "fa fa-sort" onclick="sortTable(4,'inv_table')"></i></th>
                                <th>Price <i class = "fa fa-sort" onclick="sortTable(5,'inv_table')"></i></th>
                                <th>Quantity <i class = "fa fa-sort" onclick="sortTable(6,'inv_table')"></i></th>
                                <th>Total Amount <i class = "fa fa-sort" onclick="sortTable(7,'inv_table')"></i></th>
                                <th>Journal <i class = "fa fa-sort" onclick="sortTable(8,'inv_table')"></i></th>
                                <th>Debit <i class = "fa fa-sort" onclick="sortTable(9,'inv_table')"></i></th>
                                <th>Credit <i class = "fa fa-sort" onclick="sortTable(10,'inv_table')"></i></th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $server = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "financial_db";
                        
                            $connection = new mysqli($server, $user, $pass, $db);
                        
                            if($connection->connect_error){
                                die("Connection Failed ". $connection->connect_error);
                            }

                            $sql = "SELECT * FROM inventory";
                            $result = $connection->query($sql);

                            if(!$result){
                                die("Invalid Query: ". $connection_error);
                            }

                            while($row = $result->fetch_assoc()){
                                echo "<tr>
                                    <td>" . $row["inventory_id"] . "</td>
                                    <td>" . $row["inv_date"] . "</td>
                                    <td>" . $row["supplier_id"] . "</td>
                                    <td contenteditable='true' id = 'inventory:item_name:inventory_id:". $row["inventory_id"] ."'>" . $row["item_name"] . "</td>
                                    <td contenteditable='true' id = 'inventory:category:inventory_id:". $row["inventory_id"] ."'>" . $row["category"] . "</td>
                                    <td contenteditable='true' id = 'inventory:price:inventory_id:". $row["inventory_id"] ."'>" . $row["price"] . "</td>
                                    <td contenteditable='true' id = 'inventory:quantity:inventory_id:". $row["inventory_id"] ."'>" . $row["quantity"] . "</td>
                                    <td>" . $row["total"] . "</td>
                                    <td contenteditable='true' id = 'inventory:journal:inventory_id:". $row["inventory_id"] ."'>" . $row["journal"] . "</td>
                                    <td>" . $row["debit"] . "</td>
                                    <td>" . $row["credit"] . "</td>
                                    
                                    ";$id = $row["inventory_id"];?>
                                    
                                     <td><a href="delete.php?id=<?php echo $id;?>&table=inventory:inventory_id">Delete</i></a></td>
                                </tr><?php
                            }
                            $connection->close();?>
                        </table>
                    </div>
                    <div id="add_inv_modal" class="modal">
                        <div class="modal-content" style = "width:50%;">
                            <div class="modal-header">
                                <span class="close" id = "close_inv">&times;</span>
                                <h2>Inventory Entry</h2>
                            </div>
                            <div class="modal-body">
                                <form action="insert.php" method = "post">
                                    <div class="container">
                                        <button type = "button" class = "add_inv_acc">Add</button>
                                        <button type = "button" class="remove_inv_acc">remove</button>
                                        <div id = "new_ch2">
                                            <div style="float:left;margin-right:20px;width: 50%;">
                                                <label for="inv_acc"><b>Account</b></label>
                                                <select name="inv_acc[]" required>
                                                <option id = "total_ch2" value = "1">Account</option>
                                                <?php
                                                    include("config.php");
                                                    if($connection->connect_error){
                                                        die("Connection Failed ". $connection->connect_error);
                                                    }

                                                    $sql = "SELECT account_name, account_id FROM account";
                                                    $result = $connection->query($sql);

                                                    if(!$result){
                                                        die("Invalid Query: ". $connection_error);
                                                    }

                                                    while($row = $result->fetch_assoc()){
                                                        echo "
                                                    <option value=".$row["account_id"].">".$row["account_name"]."</option>
                                                    ";
                                                    }
                                                    $connection->close();
                                                ?>
                                                </select>
                                            </div>
                                            <div style="float:right;width: 22%;">
                                                <label for="inv_debit">Debit</label>
                                                <input type="number" id="inv_debit" name="inv_debit[]" required>
                                            </div>

                                            <div style="float:right;margin-right:20px;width: 22%;">
                                                <label for="inv_credit">Credit</label>
                                                <input type="number" id="inv_credit" name="inv_credit[]" required>
                                            </div>
                                        </div>
                                        <div style="float:left;;width: 100%;">
                                            <label for="inv_exp"><b>Explanation</b></label>
                                            <input type="text" placeholder="Enter Explanation" name="inv_exp" id="inv_exp" required>  
                                        </div>

                                        <div style="float:left;margin-right:20px;width: 60%;">
                                            <label for="inv_item"><b>Item Name</b></label>
                                            <input type="text" placeholder="Enter Item Name" name="inv_item" id="inv_item" required>      
                                        </div>

                                        <div style="float:right;width: 35%;">
                                            <label for="inv_cat"><b>Category</b></label>
                                            <input type="text" placeholder="Enter Category" name="inv_cat" id="inv_cat" required> 
                                        </div>
                                        
                                        <div style="float:left;margin-right:20px;width: 25%;">
                                            <label for="supplier_id"><b>Supplier</b></label>
                                            <select name="inv_sup" required>
                                            <?php
                                                include("config.php");
                                                if($connection->connect_error){
                                                    die("Connection Failed ". $connection->connect_error);
                                                }

                                                $sql = "SELECT supplier_name FROM supplier";
                                                $result = $connection->query($sql);

                                                if(!$result){
                                                    die("Invalid Query: ". $connection_error);
                                                }

                                                while($row = $result->fetch_assoc()){
                                                    echo "
                                                <option value=".$row["supplier_name"].">".$row["supplier_name"]."</option>
                                                ";
                                                }
                                                $connection->close();
                                            ?>
                                            </select>
                                        </div>

                                        <div style="float:right;width: 22%;">
                                            <label for="inv_total"><b>Total</b></label>
                                            <input type="number" placeholder="Total" name="inv_total" id="inv_total" required readonly>      
                                        </div>

                                        <div style="float:right;margin-right:20px;width: 22%;">
                                            <label for="inv_price"><b>Price</b></label>
                                            <input type="number" placeholder="Enter Price" name="inv_price" id="inv_price" onchange = "computeTotal('inv')" required>      
                                        </div>

                                        <div style="float:right;margin-right:20px;width: 22%;">
                                            <label for="inv_quantity"><b>Quantity</b></label>
                                            <input type="number" placeholder="Enter Quantity" name="inv_quantity" id="inv_quantity" required>  
                                        </div>

                                        <input type = "submit" class = "registerbtn" name = "submit_inv" value = "SUBMIT">  
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                    <div class = "tab_tb" id = "gen_j">
                        <table id = "gen_table">
                            <tr>
                                <th>General Journal ID <i class = "fa fa-sort" onclick="sortTable(0,'gen_table')"></th>
                                <th>Date <i class = "fa fa-sort" onclick="sortTable(1,'gen_table')"></th>
                                <th>Account ID <i class = "fa fa-sort" onclick="sortTable(2,'gen_table')"></th>
                                <th>Journal <i class = "fa fa-sort" onclick="sortTable(3,'gen_table')"></th>
                                <th>Debit <i class = "fa fa-sort" onclick="sortTable(4,'gen_table')"></th>
                                <th>Credit <i class = "fa fa-sort" onclick="sortTable(5,'gen_table')"></th>
                                <th>Action</th>
                            </tr>
                                <?php
                            $server = "localhost";
                            $user = "root";
                            $pass = "";
                            $db = "financial_db";
                        
                            $connection = new mysqli($server, $user, $pass, $db);
                        
                            if($connection->connect_error){
                                die("Connection Failed ". $connection->connect_error);
                            }

                            $sql = "SELECT * FROM general";
                            $result = $connection->query($sql);

                            if(!$result){
                                die("Invalid Query: ". $connection_error);
                            }

                            while($row = $result->fetch_assoc()){
                                echo "<tr>
                                    <td>" . $row["general_id"] . "</td>
                                    <td>" . $row["date"] . "</td>
                                    <td>" . $row["account_id"] . "</td>
                                    <td>" . $row["journal"] . "</td>
                                    <td>" . $row["debit"] . "</td>
                                    <td>" . $row["credit"] . "</td>
                                    
                                    ";$id = $row["general_id"];?>
                                    
                                     <td><a href="delete.php?id=<?php echo $id;?>&table=general:general_id">Delete</i></a></td>
                                </tr><?php
                            }
                            $connection->close();?>
                        </table>
                        <button class = "btn" id = "add_gen">Add General</button>
                        <div id="add_general_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="close" id = "close_gen">&times;</span>
                                    <h2>General Entry</h2>
                                </div>
                                <div class="modal-body">
                                    <form action="insert.php" method = "post">
                                        <div class="container">

                                        <button type = "button" class = "add_gen_acc">Add</button>
                                        <button type = "button" class="remove_gen_acc">remove</button>
                                        <div id = "new_ch1">
                                            <div style="float:left;margin-right:20px;width: 50%;">
                                                <label for="gen_acc"><b>Account</b></label>
                                                <select name="gen_acc[]" required>
                                                    <option id = "total_ch1" value = "1">Account</option>
                                                    <?php
                                                        include("config.php");
                                                        if($connection->connect_error){
                                                            die("Connection Failed ". $connection->connect_error);
                                                        }

                                                        $sql = "SELECT account_name, account_id FROM account";
                                                        $result = $connection->query($sql);

                                                        if(!$result){
                                                            die("Invalid Query: ". $connection_error);
                                                        }

                                                        while($row = $result->fetch_assoc()){
                                                            echo "
                                                            <option value=".$row["account_id"].">".$row["account_name"]."</option>
                                                            ";
                                                        }
                                                        $connection->close();
                                                    ?>
                                                </select>
                                            </div>
                                            <div style="float:right;width: 22%;">
                                                <label for="gen_debit">Debit</label>
                                                <input type="number" id="gen_debit" name="gen_debit[]">
                                            </div>
                                            <div style="float:right;margin-right:20px;width: 22%;">
                                                <label for="gen_credit">Credit</label>
                                                <input type="number" id="gen_credit" name="gen_credit[]">
                                            </div>
                                            <div style="float:left;;width: 100%;">
                                                <label for="gen_exp"><b>Explanation</b></label>
                                                <input type="text" placeholder="Enter Explanation" name="gen_exp" id="gen_exp" required>      
                                            </div>
                                        </div>
                                
                                        <button type="submit" class="registerbtn" name = "submit_gen">Register</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id = "Financial_s" class = "tabContent">
                <div class = "contentNav">
                    <h4 id = "navHeader">Financial Statement</h4>
                    <p class = "date">hello</p>
                </div>   
                <div class = "financial_frame">
                    <div class = "financial_buttons">
                        <button class = "buttonLink" onclick="openTable(event, 'income')">Income Statement</button>
                        <button class = "buttonLink" onclick="openTable(event, 'balance')">Balance Sheet</button>
                    </div>
                    <div class = "tab_tb" id = "income">
                        <table>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                            </tr>
                            <tr>
                                <td>Sales</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Cost of Goods Sold</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Gross Profit</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Water Expenses</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Internet</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Electricty</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Total Expenses</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Net Income</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class = "tab_tb" id = "balance">
                        <table>
                            <tr>
                                <th>Account Name</th>
                                <th>Debit</th>
                                <th>Credit</th>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Assets</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Cash</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Inventory</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Account Receivable</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Total Assets</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Liabilities</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Account Payable</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Total Liabilities</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Owner Equity</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Capital</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div id = "Payable" class = "tabContent">
                <div class = "contentNav">
                    <h4 id = "navHeader">Account Payable</h4>
                    <p class = "date">hello</p>
                </div>   
                <div class = "account_frame">
                    <input type="text" id = "ap_search" placeholder="Search" >
                    <table>
                        <tr>
                            <th>Account Receivable ID</th>
                            <th>Sales ID</th>
                            <th>Customer ID</th>
                            <th>Initial Payment</th>
                            <th>Collection of AR</th>
                            <th>Total Collection</th>
                            <th>Account Amount</th>
                        </tr>
                    </table>
                </div>
            </div>
            <div id = "Receivable" class = "tabContent">
                <div class = "contentNav">
                    <h4 id = "navHeader">Account Receivable</h4>
                    <p class = "date">hello</p>
                </div>   
                <div class = "account_frame">
                    <input type="text" id = "ar_search" placeholder="Search" >
                    <table>
                        <tr>
                            <th>Account Payable ID</th>
                            <th>Inventory ID</th>
                            <th>Initial Payment</th>
                            <th>Collection of AR</th>
                            <th>Total Collection</th>
                            <th>Account Amount</th>
                        </tr>
                    </table>
                </div>
            </div>
            <div id = "Inventory" class = "tabContent">
                <div class = "contentNav">
                    <h4 id = "navHeader">Inventory</h4>
                    <p class = "date">hello</p>
                </div> 
                <div class = "inventory_frame">
                    <div class = "inventory_buttons">
                        <button class = "buttonLink" onclick="openTable(event, 'merch')">Merchandise</button>
                        <button class = "buttonLink" onclick="openTable(event, 'stock')">Stock Record</button>
                        <button class = "buttonLink" onclick="openTable(event, 'supp')">Supplier</button>
                    </div>
                    <div class = "tab_tb" id = "merch">
                        <input type="text" id = "merch_search" placeholder="Search" >
                        <table>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                            </tr>
                            <?php
                                include("config.php");
                                if($connection->connect_error){
                                    die("Connection Failed ". $connection->connect_error);
                                }

                                $sql = "SELECT * FROM merchandise";
                                $result = $connection->query($sql);

                                if(!$result){
                                    die("Invalid Query: ". $connection_error);
                                }

                                while($row = $result->fetch_assoc()){
                                    echo "<tbody data-link='row' class='rowlink'>
                                    <tr>
                                        <td>" . $row["item_id"] . "</td>
                                        <td contenteditable='true' id = 'merchandise:item_name:item_id:". $row["item_id"] ."'>" . $row["item_name"] . "</td>
                                        <td contenteditable='true' id = 'merchandise:item_category:item_id:". $row["item_id"] ."'>" . $row["item_category"] . "</td>
                                        <td>" . $row["item_stock"] . "</td>
                                        ";$id = $row["item_id"];?>
                                        
                                        <td><a href="delete.php?id=<?php echo $id;?>&table=merchandise:item_id">Delete</i></a></td>
                                </tr><?php
                            }
                            $connection->close();?>
                        </table>
                    </div>
                    <div class = "tab_tb" id = "stock" style="overflow-x:auto; overflow-x:auto;"> 
                        <input type="text" id = "merch_search" placeholder="Search" >
                        <input onclick="change()" type="button" value="In" id="stock_switch"></input>
                        <div class = "stock_tb" id = "in"> 
                            <table>
                                <tr>
                                    <th>Stock ID</th>
                                    <th>Journal ID</th>
                                    <th>Date</th>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>Supplier Name</th>
                                    <th>Category</th>
                                    <th>Item Unit Price</th>
                                    <th>Item Quantity</th>
                                    <th>Total Price</th> 
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    
                                </tr>
                            </table>
                        </div>
                        <div class = "stock_tb" id = "out" style="display:none;" > 
                            <table>
                                <tr>
                                    <th>Stock ID</th>
                                    <th>Journal ID</th>
                                    <th>Date</th>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>Supplier Name</th>
                                    <th>Category</th>
                                    <th>Item Unit Price</th>
                                    <th>Item Quantity</th>
                                    <th>Total Price</th> 
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class = "tab_tb" id = "supp">
                        <input type="text" id = "supp_search" placeholder="Search" >
                        <table id = "sup_table">
                            <tr>
                                <th>Supplier ID <i class = "fa fa-sort" onclick="sortTable(0,'sup_table')"></th>
                                <th>Supplier Name <i class = "fa fa-sort" onclick="sortTable(1,'sup_table')"></th>
                                <th>Address <i class = "fa fa-sort" onclick="sortTable(2,'sup_table')"></th>
                                <th>Contact Number <i class = "fa fa-sort" onclick="sortTable(3,'sup_table')"></th>
                                <th>Action</th>
                            </tr>
                            <?php
                            include("config.php");
                            if($connection->connect_error){
                                die("Connection Failed ". $connection->connect_error);
                            }

                            $sql = "SELECT * FROM supplier";
                            $result = $connection->query($sql);

                            if(!$result){
                                die("Invalid Query: ". $connection_error);
                            }

                            while($row = $result->fetch_assoc()){
                                echo "<tbody data-link='row' class='rowlink'>
                                <tr>
                                    <td>" . $row["supplier_ID"] . "</td>
                                    <td contenteditable='true' id = 'supplier:supplier_name:supplier_ID:". $row["supplier_ID"] ."'>" . $row["supplier_name"] . "</td>
                                    <td contenteditable='true' id = 'supplier:address:supplier_ID:". $row["supplier_ID"] ."'>" . $row["address"] . "</td>
                                    <td contenteditable='true' id = 'supplier:contact:supplier_ID:". $row["supplier_ID"] ."'>" . $row["contact"] . "</td>
                                    ";$id = $row["supplier_ID"];?>
                                    
                                    <td><a href="delete.php?id=<?php echo $id;?>&table=supplier:supplier_id">Delete</i></a></td>
                               </tr><?php
                           }
                           $connection->close();?>
                        </table>
                        <button class = "btn" id = "add_supplier">Add Supplier</button>
                        <div id="add_supplier_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="close" id = "close_sup">&times;</span>
                                    <h2>Add Supplier</h2>
                                </div>
                                <div class="modal-body">
                                    <form action="insert.php" method = "post">
                                        <div class="container">
        
                                        <label for="Sup_name"><b>Name</b></label>
                                        <input type="text" placeholder="Enter Name" name="sup_name" id="sup_name" required>
                                
                                        <label for="sup_adr"><b>Address</b></label>
                                        <input type="text" placeholder="Enter Address" name="sup_adr" id="sup_adr" required> 
                                    
                                        <label for="sup_no"><b>Contact Number</b></label>
                                        <input type="number" placeholder="Enter Contact Number" name="sup_no" id="sup_no" required>
                                        
                                        <button type="submit" class="registerbtn" name = "submit_sup">Register</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id = "Logs" class = "tabContent">
                <div class = "contentNav">
                    <h4 id = "navHeader">Logs</h4>
                    <p class = "date">hello</p>
                </div>   
                <div class = "account_frame" style="overflow-y:auto;">
                    <input type="text" id = "ap_search" placeholder="Search" >
                    <div>
                    <table>
                        <tr>
                            <th>Log ID</th>
                            <th>Admin ID</th>
                            <th>Login</th>
                            <th>Logout</th>
                        </tr>
                        <tbody>
                        <?php
                            include("config.php");
                            if($connection->connect_error){
                                die("Connection Failed ". $connection->connect_error);
                            }

                            $sql = "SELECT * FROM logs";
                            $result = $connection->query($sql);

                            if(!$result){
                                die("Invalid Query: ". $connection_error);
                            }

                            while($row = $result->fetch_assoc()){
                                echo "<tbody data-link='row' class='rowlink'>
                                <tr>
                                    <td>" . $row["log_id"] . "</td>
                                    <td>" . $row["admin_id"] . "</td>
                                    <td>" . $row["login"] . "</td>
                                    <td>" . $row["logout"] . "</td>
                                    
                                    ";$id = $row["log_id"];?>
                                    
                                    <td><a href="delete.php?id=<?php echo $id;?>&table=logs:log_id">Delete</i></a></td>
                               </tr><?php
                           }
                           $connection->close();?>
                        </tbody>
                    </table>
                        </div>
                </div>
            </div>
            <div id = "Admin" class = "tabContent">
                <div class = "contentNav">
                    <h4 id = "navHeader">Manage Admin</h4>
                    <p class = "date">hello</p>
                </div>   
                <div class = "account_frame">
                    <input type="text" id = "ap_search" placeholder="Search" >
                    <table>
                        <tr>
                            <th>Admin ID</th>
                            <th>Admin name</th>
                            <th>Admin Password</th>
                            <th>Admin Contact</th>
                            <th>Address</th>
                            <th>Admin Key</th>
                            <th>Admin Role</th>
                        </tr>
                        <?php
                            include("config.php");
                            if($connection->connect_error){
                                die("Connection Failed ". $connection->connect_error);
                            }

                            $sql = "SELECT * FROM admin";
                            $result = $connection->query($sql);

                            if(!$result){
                                die("Invalid Query: ". $connection_error);
                            }

                            while($row = $result->fetch_assoc()){
                                echo "<tbody data-link='row' class='rowlink'>
                                <tr>
                                    <td>" . $row["admin_id"] . "</td>
                                    <td contenteditable='true' id = 'admin:admin_name:admin_id:". $row["admin_id"] ."'>" . $row["admin_name"] . "</td>
                                    <td contenteditable='true' id = 'admin:admin_pass:admin_id:". $row["admin_id"] ."'>" . $row["admin_pass"] . "</td>
                                    <td contenteditable='true' id = 'admin:admin_contact:admin_id:". $row["admin_id"] ."'>" . $row["admin_contact"] . "</td>
                                    <td contenteditable='true' id = 'admin:address:admin_id:". $row["admin_id"] ."'>" . $row["address"] . "</td>
                                    <td contenteditable='true' id = 'admin:admin_key:admin_id:". $row["admin_id"] ."'>" . $row["admin_key"] . "</td>
                                    <td contenteditable='true' id = 'admin:admin_role:admin_id:". $row["admin_id"] ."'>" . $row["admin_role"] . "</td>
                                    ";$id = $row["admin_id"];?>
                                    
                                    <td><a href="delete.php?id=<?php echo $id;?>&table=admin:admin_id">Delete</i></a></td>
                               </tr><?php
                           }
                           $connection->close();?>
                    </table>
                    <button class = "btn" id = "add_admin">Register</button>
                        <div id="add_admin_modal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="close" id = "close_admin">&times;</span>
                                    <h2>Register</h2>
                                </div>
                                <div class="modal-body">
                                    <form action="insert.php" method = "post">
                                        <div class="container">
        
                                        <label for="admin_name"><b>Name</b></label>
                                        <input type="text" placeholder="Enter Name" name="admin_name" id="admin_name" required>
                                
                                        <label for="admin_pass"><b>Password</b></label>
                                        <input type="password" placeholder="Enter Password" name="admin_pass" id="admin_pass" required> 
                                    
                                        <label for="admin_no"><b>Contact Number</b></label>
                                        <input type="number" placeholder="Enter Contact Number" name="admin_no" id="admin_no" required>
                                        
                                        <label for="admin_address"><b>Address</b></label>
                                        <input type="text" placeholder="Enter Address" name="admin_address" id="admin_address" required>
                                        
                                        <label for="admin_role"><b>Admin Role</b></label>
                                        <select name = "admin_role" required>
                                            <option value = "Admin">Admin</option>
                                            <option value = "Owner">Owner</option>
                                        </select>

                                        <button type="submit" class="registerbtn" name = "submit_admin">Register</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </div>
        </div>
    </body>
    <script>

        if(<?php echo json_encode($role); ?> == "Admin"){

            x = document.getElementById("admin_1");
            y = document.getElementById("admin_2");
            z = document.getElementById("admin_3");
            x.style.display = "none";
            y.style.display = "none";
            z.style.display = "none";

        }
        $(function(){

            $("#loading").hide();
            //acknowledgement message
            var message_status = $("#status");
            $("td[contenteditable=true]").blur(function(){
                var field_userid = $(this).attr("id") ;
                var value = $(this).text() ;

                $.post('update.php' , field_userid + "=" + value, function(data){

                    if(data != '')
                    {
                        message_status.show();
                        message_status.text(data);
                        //hide the message
                        setTimeout(function(){message_status.hide()},1000);
                    }
                });
            });
       
        });

        $(function(){

            $("i").click(function(){
                var field = $(this).attr("id") ;
         
                $.post('sort.php' , field, function(data){
                    
                    if(data != '')
                    {
                        message_status.show();
                        message_status.text(data);
                        //hide the message
                        setTimeout(function(){message_status.hide()},1000);
                        
                    }
                });
            });

        });

        function openTab(evt, tabname) {
            var i, x, tablinks;
            x = document.getElementsByClassName("tabContent");
       
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
                
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", ""); 
            }
            document.getElementById(tabname).style.display = "block";
            evt.currentTarget.className += " active";

            date = document.getElementsByClassName("date");
            for(i = 0; i < date.length; i++){
                date[i].innerHTML = Date();
            }
        }
        function openTable(evt, tabname){
            var i, x, buttonLink;
            x = document.getElementsByClassName("tab_tb");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            buttonLink = document.getElementsByClassName("buttonLink");
            for (i = 0; i < x.length; i++) {
                buttonLink[i].className = buttonLink[i].className.replace(" active", ""); 
            }
            document.getElementById(tabname).style.display = "block";
            evt.currentTarget.className += " active";
        }

        var acc_modal = document.getElementById("create_acc_modal");
        var acc_btn = document.getElementById("add_acc");
        var acc_span = document.getElementsByClassName("close")[0];

        var sup_modal = document.getElementById("add_supplier_modal");
        var sup_btn = document.getElementById("add_supplier");
        var sup_span = document.getElementById("close_sup");

        var sales_modal = document.getElementById("add_sales_modal");
        var sales_btn = document.getElementById("add_sales");
        var sales_span = document.getElementById("close_sales");

        var inv_modal = document.getElementById("add_inv_modal");
        var inv_btn = document.getElementById("add_inv");
        var inv_span = document.getElementById("close_inv");

        var gen_modal = document.getElementById("add_general_modal");
        var gen_btn = document.getElementById("add_gen");
        var gen_span = document.getElementById("close_gen");

        var admin_modal = document.getElementById("add_admin_modal");
        var admin_btn = document.getElementById("add_admin");
        var admin_span = document.getElementById("close_admin");

        acc_btn.onclick = function() {
            acc_modal.style.display = "block";
        }
        acc_span.onclick = function() {
            acc_modal.style.display = "none";
        }

        sup_btn.onclick = function() {
            sup_modal.style.display = "block";
        }
        sup_span.onclick = function() {
            sup_modal.style.display = "none";
        }

        sales_btn.onclick = function() {
            sales_modal.style.display = "block";
        }
        sales_span.onclick = function() {
            sales_modal.style.display = "none";
        }

        inv_btn.onclick = function() {
            inv_modal.style.display = "block";
        }
        inv_span.onclick = function() {
            inv_modal.style.display = "none";
        }
        gen_btn.onclick = function() {
            gen_modal.style.display = "block";
        }
        gen_span.onclick = function() {
            gen_modal.style.display = "none";
        }
        admin_btn.onclick = function() {
            admin_modal.style.display = "block";
        }
        admin_span.onclick = function() {
            admin_modal.style.display = "none";
        }

        function open_menu(){
            document.getElementById("myDropdown").classList.toggle("show");
        }
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

$('.add_gen_acc').on('click', add_gen_acc);
$('.remove_gen_acc').on('click', remove_gen_acc);
//ch1 = general entry
//ch2 = inventory entry
//ch3 = sales entry
function add_gen_acc() {
    var new_chq_no = parseInt($('#total_ch1').val()) + 1;
    var new_ch1 = "<div id='new_" + new_chq_no + "' ><div id='new_" + new_chq_no + "' style='float:left;margin-right:20px;width: 50%;'><label for='gen_acc'><b>Account</b></label><select name='gen_acc[]' required><option id = 'total_ch1' value = '0'>Account</option><?php include('config.php');if($connection->connect_error){die('Connection Failed '. $connection->connect_error); }$sql = 'SELECT account_name, account_id FROM account';$result = $connection->query($sql);if(!$result){die('Invalid Query: '. $connection_error);}while($row = $result->fetch_assoc()){echo '<option value='.$row['account_id'].'>'.$row['account_name'].'</option>';}$connection->close();?></select></div><div style='float:right;width: 22%;'><label for='gen_debit'>Debit</label><input type='number' id='gen_debit' name='gen_debit[]'></div><div style='float:right;margin-right:20px;width: 22%;'><label for='gen_credit'>Credit</label><input type='number' id='gen_credit' name='gen_credit[]'></div><div style='float:left;;width: 100%;''></div>";

    $('#new_ch1').append(new_ch1);
    $('#total_ch1').val(new_chq_no);

}
function remove_gen_acc() {
    var last_chq_no = $('#total_ch1').val();

    if (last_chq_no > 1) {
        $('#new_' + last_chq_no).remove();
        $('#total_ch1').val(last_chq_no - 1);
    }
}
$('.add_inv_acc').on('click', add_inv_acc);
$('.remove_inv_acc').on('click', remove_inv_acc);
function add_inv_acc() {
    var new_chq_no = parseInt($('#total_ch2').val()) + 1;
    var new_ch2 = "<div id='new_" + new_chq_no + "' ><div id='new_" + new_chq_no + "' style='float:left;margin-right:20px;width: 50%;'><label for='inv_acc'><b>Account</b></label><select name='inv_acc[]' required><option id = 'total_ch2' value = '0'>Account</option><?php include('config.php');if($connection->connect_error){die('Connection Failed '. $connection->connect_error); }$sql = 'SELECT account_name, account_id FROM account';$result = $connection->query($sql);if(!$result){die('Invalid Query: '. $connection_error);}while($row = $result->fetch_assoc()){echo '<option value='.$row['account_id'].'>'.$row['account_name'].'</option>';}$connection->close();?></select></div><div style='float:right;width: 22%;'><label for='inv_debit'>Debit</label><input type='number' id='inv_debit' name='inv_debit[]'></div><div style='float:right;margin-right:20px;width: 22%;'><label for='inv_credit'>Credit</label><input type='number' id='inv_credit' name='inv_credit[]'></div><div style='float:left;;width: 100%;'></div>";
    
    $('#new_ch2').append(new_ch2);
    $('#total_ch2').val(new_chq_no);
}
function remove_inv_acc() {
    var last_chq_no = $('#total_ch2').val();

    if (last_chq_no > 1) {
        $('#new_' + last_chq_no).remove();
        $('#total_ch2').val(last_chq_no - 1);
    }
}

$('.add_sales_acc').on('click', add_sales_acc);
$('.remove_sales_acc').on('click', remove_sales_acc);
function add_sales_acc() {
    var new_chq_no = parseInt($('#total_ch3').val()) + 1;
    var new_ch3 = "<div id='new_" + new_chq_no + "' ><div id='new_" + new_chq_no + "' style='float:left;margin-right:20px;width: 50%;'><label for='sales_acc'><b>Account</b></label><select name='sales_acc[]' required><option id = 'total_ch3' value = '0'>Account</option><?php include('config.php');if($connection->connect_error){die('Connection Failed '. $connection->connect_error); }$sql = 'SELECT account_name, account_id FROM account';$result = $connection->query($sql);if(!$result){die('Invalid Query: '. $connection_error);}while($row = $result->fetch_assoc()){echo '<option value='.$row['account_id'].'>'.$row['account_name'].'</option>';}$connection->close();?></select></div><div style='float:right;width: 22%;'><label for='sales_debit'>Debit</label><input type='number' id='sales_debit' name='sales_debit[]'></div><div style='float:right;margin-right:20px;width: 22%;'><label for='sales_credit'>Credit</label><input type='number' id='sales_credit' name='sales_credit[]'></div><div style='float:left;;width: 100%;''></div>";

    $('#new_ch3').append(new_ch3);
    $('#total_ch3').val(new_chq_no);
}
function remove_sales_acc() {
    var last_chq_no = $('#total_ch3').val();

    if (last_chq_no > 1) {
        $('#new_' + last_chq_no).remove();
        $('#total_ch3').val(last_chq_no - 1);
    }
}
function change() // no ';' here
{
    var elem = document.getElementById("stock_switch");
    if (elem.value=="Out") {
        elem.value = "In";
        
        document.getElementById("in").style.display="block";
        document.getElementById("out").style.display="none";
    }
    else{
        elem.value = "Out";
        document.getElementById("out").style.display="block";
        document.getElementById("in").style.display="none";
    }
}

//sorting

function sortTable(n,t) { //can only sort up to 2 digits
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(t);
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc"; 
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
        //start by saying there should be no switching:
        shouldSwitch = false;
        /*Get the two elements you want to compare,
        one from current row and one from the next:*/
        x = rows[i].getElementsByTagName("TD")[n];
        //alert(x.innerHTML);
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /*check if the two rows should switch place,
        based on the direction, asc or desc:*/
        /*if(x.innerHTML === x.innerHTML && x.innerHTML % 1 !== 0){
            alert("yes");
        }*/
        
        if (dir == "asc") {
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch= true;
            break;
            }
        } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
        }
      }
    }
    if (shouldSwitch) {
        /*If a switch has been marked, make the switch
        and mark that a switch has been done:*/
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        //Each time a switch is done, increase this count by 1:
        switchcount ++;      
    } else {
        /*If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again.*/
        if (switchcount == 0 && dir == "asc") {
            dir = "desc";
            switching = true;
        }
    }
  }
}
function computeTotal(code){
    //alert(code);
    var price = document.getElementById(code+"_price").value;
    var quantity = document.getElementById(code+"_quantity").value;
    var total = price * quantity;

    document.getElementById(code+"_total").value = total;
    
}
    </script>
</html>