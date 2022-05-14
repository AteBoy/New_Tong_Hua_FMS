
<form action ="array.php" method="post">

    <button type = "button" class = "add">Add</button>
    <button type = "button" class="remove">remove</button>
    <div id = "new_chq">
        <div style="float:left;margin-right:20px;width: 50%;">
            <label for="gen_acc"><b>Account</b></label>
            <select name="gen_acc[]" required>
                <option id = "total_chq" value = "1">Account</option>
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
    </div>
    <button type="submit" class="registerbtn" name = "submit_gen[]">Register</button>
</form>

<!--ignore this part -->
<?php
if (!empty($_POST["op"])) {
    $t = $_POST["anything"];

    for ($i = 0; $i < count($t)-1; $i++) {
        if (strlen($_POST["anything"][$i]) !== 0) {
            ?>
            <p>The value of the <?php echo $i+1; ?> text field is: <?php echo $_POST["anything"][$i]; ?>
                <?php
            } else {
                ?>
            <p><?php echo $i; ?> was not set.</p>
            <?php
        }
    }
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

$('.add').on('click', add);
$('.remove').on('click', remove);

function add() {
  var new_chq_no = parseInt($('#total_chq').val()) + 1;

    var new_chq = "<div id='new_" + new_chq_no + "' ><div id='new_" + new_chq_no + "' style='float:left;margin-right:20px;width: 50%;'><label for='gen_acc'><b>Account</b></label><select name='gen_acc[]' required><option id = 'total_chq' value = '1'>Account</option><?php include('config.php');if($connection->connect_error){die('Connection Failed '. $connection->connect_error); }$sql = 'SELECT account_name, account_id FROM account';$result = $connection->query($sql);if(!$result){die('Invalid Query: '. $connection_error);}while($row = $result->fetch_assoc()){echo '<option value='.$row['account_id'].'>'.$row['account_name'].'</option>';}$connection->close();?></select></div><div style='float:right;width: 22%;'><label for='gen_debit'>Debit</label><input type='number' id='gen_debit' name='gen_debit[]'></div><div style='float:right;margin-right:20px;width: 22%;'><label for='gen_credit'>Credit</label><input type='number' id='gen_credit' name='gen_credit[]'></div></div>";


$('#new_chq').append(new_chq);

$('#total_chq').val(new_chq_no);
}
function remove() {
  var last_chq_no = $('#total_chq').val();

  if (last_chq_no > 1) {
    $('#new_' + last_chq_no).remove();
    $('#total_chq').val(last_chq_no - 1);
  }
}
</script>