<!DOCTYPE html>
<html>
<head>
<title>Sort a HTML Table Alphabetically</title>
<style>
table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
</style>
</head>
<body>


<table id="account">
  <tr>
   <!--When a header is clicked, run the sortTable function, with a parameter, 0 for sorting by names, 1 for sorting by country:-->  
    <th onclick="sortTable(0,'account:account_id')">Account ID</th>
    <th onclick="sortTable(1,'account:account_name')">Account Name</th>
    <th onclick="sortTable(2,'account:account_type')">Account Type</th>
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
                       <table id="gen_table">
  <tr>
   <!--When a header is clicked, run the sortTable function, with a parameter, 0 for sorting by names, 1 for sorting by country:-->  
    <th onclick="sortTable(0,'gen_table')">Account ID</th>
    <th onclick="sortTable(1,'gen_table')">Account Name</th>
    <th onclick="sortTable(2,'gen_table')">Account Type</th>
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
<script>
function sortTable(n,t) {
  
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  tablename = t.split(":");
  table = document.getElementById(tablename[0]);
  <?php $table1 = "<script>document.getElementById(tablename[0]);</script>"; 
        $column = "<script>document.getElementById(tablename[1]);</script>";
  ?>
  switching = true;
  <?php 
  include("config.php");

  if($connection->connect_error){
      die("Connection FailedL ". $connection->connect_error);
  }
  $sql = "SELECT $column FROM $table1";
  $result = $connection->query($sql);

  if(!$result){
      die("Invalid Query: ". $connection_error);
  }
  ?>
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
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
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
</script>

</body>
</html>
