<?php 
include("config.php");

if($connection->connect_error){
    die("Connection FailedL ". $connection->connect_error);
}

if(isset($_POST['submit_gen'])){

    $a = $_POST["gen_acc"];
    $b = $_POST["gen_debit"];
    $c = $_POST["gen_credit"];
//    echo "<script>alert('$c[0]');</script>";
    for ($i = 0; $i < count($a); $i++) {
        if (strlen($_POST["gen_acc"][$i]) !== 0) {
            ?>
            <p>The value of the <?php echo $i+1; ?> account field is: <?php echo $a[$i]; ?>
            <p>The value of the <?php echo $i+1; ?> debit field is: <?php echo $b[$i]; ?>
            <p>The value of the <?php echo $i+1; ?> credit field is: <?php echo $c[$i]; ?>
                <?php
            } else {
                ?>
            <p><?php echo $i; ?> was not set.</p>
            <?php
        }
    }
}

?>