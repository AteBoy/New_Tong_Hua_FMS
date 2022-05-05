<html>
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
        <link rel= "stylesheet" type= "text/css" href= "style/style.css">
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
            <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Dashboard')">Dashboard</a></li> 
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Accounts')">Accounts</a></li>
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Journal')">Journal Entry</a></li>
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Payable')">Payable</a></li>
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Receivable')">Receivable</a></li>  
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Inventory')">Inventory</a></li> 
                <li><a href = "##" class = "tablink" onclick = "openTab(event, 'Financial_s')">Financial Statement</a></li>      
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
                        <h4 id = "label">Users</h4>
                    </div>
                    <div class = "tb_bottom">
                        
                    </div>
                </div>
                <div class = "box_tb" style="background-color: limegreen;">
                    <div class = "box_info">
                        <h4 id = "number">0</h4>
                        <h4 id = "label">Total Sales</h4>
                    </div>
                    <div class = "tb_bottom">
                        
                    </div>
                </div>
                <div class = "box_tb" style="background-color: royalblue;">
                    <div class = "box_info">
                        <h4 id = "number">0</h4>
                        <h4 id = "label">Expenses</h4>
                    </div>
                    <div class = "tb_bottom">
                        
                    </div>
                </div>
                <div class = "box_tb" style="background-color: indianred;">
                    <div class = "box_info">
                        <h4 id = "number">0</h4>
                        <h4 id = "label">Profit</h4>
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
                    <table>
                        <tr>
                            <th>Account Number <i class = "fa fa-sort" id = "account:account_id"></i> </th>
                            <th>Account Name</th>
                            <th>Account Type</th>
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
                                    
                                    <td><a href="delete.php?id=<?php echo $id;?>&table=account">Delete</i></a></td>
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
                        <table>
                            <tr>
                                <th>Date</th>
                                <th>Account Title and Explanation</th>
                                <th>Journal Entry ID</th>
                                <th>Journal</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                               
                            </tr>
                        </table>
        
                    </div>
                    <div class = "tab_tb" id = "sale_j" style="overflow-x:auto;">
                        <button class = "btn" id = "add_sales">New Entry</button>
                        <table>
                            <tr>
                                <th>Sale ID</th>
                                <th>Date</th>
                                <th>Buyer Name</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Journal</th>
                                <th>Debit</th>
                                <th>Credit</th>
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
                                    
                                    <td><a href="delete.php?id=<?php echo $id;?>&table=sales">Delete</i></a></td>
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
                                    <div style="float:left;margin-right:20px;width: 50%;">
                                    <label for="sales_acc"><b>Account ID</b></label>
                                    <select name="sales_acc" required>
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
                                        <label for="inv_debit">Debit</label>
                                        <input type="number" id="inv_debit" name="inv_credit" required>
                                    </div>
                                    <div style="float:right;margin-right:20px;width: 22%;">
                                        <label for="inv_credit">Credit</label>
                                        <input type="number" id="inv_credit" name="inv_credit" required>
                                    </div>

                                    <div style="float:left;;width: 100%;">
                                        <label for="sales_exp"><b>Explanation</b></label>
                                        <input type="text" placeholder="Enter Explanation" name="inv_exp" id="inv_exp" required>      
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
                                        <input type="number" placeholder="Enter Price" name="sales_price" id="sales_price" required>      
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
                        <table>
                            <tr>
                                <th>Inventory ID</th>
                                <th>Date</th>
                                <th>Supplier Name</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Journal</th>
                                <th>Debit</th>
                                <th>Credit</th>
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
                                    
                                     <td><a href="delete.php?id=<?php echo $id;?>&table=inventory">Delete</i></a></td>
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
            
                                    <div style="float:left;margin-right:20px;width: 50%;">
                                        <label for="inv_acc"><b>Account</b></label>
                                        <select name="inv_acc" required>
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
                                        <input type="number" id="inv_debit" name="inv_debit" required>
                                    </div>

                                    <div style="float:right;margin-right:20px;width: 22%;">
                                        <label for="inv_credit">Credit</label>
                                        <input type="number" id="inv_credit" name="inv_credit" required>
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
                                        <input type="number" placeholder="Enter Price" name="inv_price" id="inv_price" required>      
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
                        <table>
                            <tr>
                                <th>General Journal ID</th>
                                <th>Date</th>
                                <th>Account ID</th>
                                <th>Journal</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Action</th>
                            </tr>
                            <tr>
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
                                    
                                     <td><a href="delete.php?id=<?php echo $id;?>&table=general">Delete</i></a></td>
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

                                        <div style="float:left;margin-right:20px;width: 50%;">
                                        <label for="gen_acc"><b>Account</b></label>
                                        <select name="gen_acc" required>
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
                                            <input type="number" id="gen_debit" name="gen_debit">
                                        </div>
                                        <div style="float:right;margin-right:20px;width: 22%;">
                                            <label for="gen_credit">Credit</label>
                                            <input type="number" id="gen_credit" name="gen_credit">
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
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class = "tab_tb" id = "stock" style="overflow-x:auto; overflow-x:auto;"> 
                        <input type="text" id = "merch_search" placeholder="Search" >
                        <table>
                            <tr>
                                <th>Stock ID</th>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Supplier Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity (In)</th>
                                <th>Quantity (Out)</th>
                                <th>Total Price</th> 
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><div contenteditable>hi</div></td>
                                <td>hiiiiiiiiii</td>
                                <td>hiiiiiiiiii</td>
                                <td>hiiiiiiiiii</td>
                                <td>hiiiiiiiiii</td>
                                <td>hiiiiiiiiii</td>
                                <td>hiiiiiiiiii</td>
                                <td>hiiiiiiiiii</td>
                                <td>hiiiiiiiiii</td>
                                <td>hiiiiiiiiii</td>
                            </tr>
                        </table>
                    </div>
                    <div class = "tab_tb" id = "supp">
                        <input type="text" id = "supp_search" placeholder="Search" >
                        <table>
                            <tr>
                                <th>Supplier ID</th>
                                <th>Supplier Name</th>
                                <th>Address</th>
                                <th>Contact Number</th>
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
                                    
                                    <td><a href="delete.php?id=<?php echo $id;?>&table=supplier">Delete</i></a></td>
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
            </div>
        </div>
    </body>
    <script>
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
        /*$(document).ready(function(){
            $("i").click(function(){
                var field = $(this).attr("id";

                $.post('sort.php'){
                    
                };
            });
        });*/
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
        
    </script>
</html>