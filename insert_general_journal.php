<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "financial_db";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database);

    if($connection->connect_error){
        die("Connection FailedL ". $connection->connect_error);
    }

        //Query for Journal Entry ID
        $query_last_journal_entry_id = "SELECT
                                    journal_entry_id
                                    FROM
                                    journal_entry
                                    ORDER BY
                                    journal_entry_id
                                    DESC
                                    LIMIT 1";

        $result_last_journal_entry_id = $connection->query($query_last_journal_entry_id);
        $row_count = mysqli_num_rows($result_last_journal_entry_id);

        if ($row_count == 0) {
            $new_journal_entry_id = "JS-000001";
        }

        else{
            while ($row_last_journal_entry_id = $result_last_journal_entry_id->fetch_assoc()){
                $temp_journal_entry_id = $row_last_journal_entry_id["journal_entry_id"];
                $get_num_journal_entry_id = str_replace("JS-", "", $temp_journal_entry_id);
                $increment_journal_entry_id = $get_num_journal_entry_id + 1;
                $string_journal_entry_id = str_pad($increment_journal_entry_id, 6,0, STR_PAD_LEFT);
                $new_journal_entry_id =  "JS-".$string_journal_entry_id;  
            }   
        }

        //Query for Posting ID
        $query_last_posting_id = "SELECT
                            journal_entry_posting_id
                            FROM
                            journal_entry
                            ORDER BY
                            journal_entry_posting_id
                            DESC
                            LIMIT 1";

        $result_last_posting_id = $connection->query($query_last_posting_id);
        $row_count2 = mysqli_num_rows($result_last_posting_id);

        if ($row_count2 == 0) {
            $increment_posting_id= 1;
        }

        else {
            while ($row_last_posting_id = $result_last_posting_id->fetch_assoc()) {
                $temp_posting_id = $row_last_posting_id["journal_entry_posting_id"];
                $get_num_posting_id = str_replace("PS-", "", $temp_posting_id);
                $increment_posting_id = $get_num_posting_id + 1;                          
            }
        }

        $current_date = date("Y-m-d");
        
        for ($i=0; $i < count($_POST['gen_acc']); $i++) { 
            $account_name = $_POST['gen_acc'][$i];
            $debit = $_POST['gen_debit'][$i];
            $credit = $_POST['gen_credit'][$i];

            $journal_entry_description = $_POST['gen_exp'];
            
            $query_account_id_table = "SELECT
                                    account_name, account_id, account_type
                                    FROM
                                    account
                                    WHERE
                                    account_name = '$account_name'";

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


                if ($debit > $credit) {
                    if ($account_type == "Asset" || $account_type == "Expenses") {
                        $query_insert_into_database = "INSERT INTO
                                                journal_entry(journal_entry_posting_id, journal_entry_date, journal_entry_id, journal_entry_account_id, journal_entry_amount, journal_entry_description)
                                                VALUES
                                                ('$new_posting_id', '$current_date', '$new_journal_entry_id', '$account_id', '$debit', '$journal_entry_description')";
                    }
                    else if ($account_type == "Liability" || $account_type == "Owners Equity" || $account_type == "Income") {
                        $debit = $debit * -1;
                        $query_insert_into_database = "INSERT INTO
                                                journal_entry(journal_entry_posting_id, journal_entry_date, journal_entry_id, journal_entry_account_id, journal_entry_amount, journal_entry_description)
                                                VALUES
                                                ('$new_posting_id', '$current_date', '$new_journal_entry_id', '$account_id', '$debit', '$journal_entry_description')";                        
                    }
                }

                else if ($debit < $credit) {
                    if ($account_type == "Asset" || $account_type == "Expenses") {
                        $credit = $credit * -1;
                        $query_insert_into_database = "INSERT INTO
                                                journal_entry(journal_entry_posting_id, journal_entry_date, journal_entry_id, journal_entry_account_id, journal_entry_amount, journal_entry_description)
                                                VALUES
                                                ('$new_posting_id', '$current_date', '$new_journal_entry_id', '$account_id', '$credit', '$journal_entry_description')";
                    }
                    else if ($account_type == "Liability" || $account_type == "Owners Equity" || $account_type == "Income"){
                        $query_insert_into_database = "INSERT INTO
                                                journal_entry(journal_entry_posting_id, journal_entry_date, journal_entry_id, journal_entry_account_id, journal_entry_amount, journal_entry_description)
                                                VALUES
                                                ('$new_posting_id', '$current_date', '$new_journal_entry_id', '$account_id', '$credit', '$journal_entry_description')";
                    }
                }
                
            $result_insert_into_database = $connection->query($query_insert_into_database);

        }
    $connection->close();
?>