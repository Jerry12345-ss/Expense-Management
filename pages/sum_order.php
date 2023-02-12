<?php 
    // Database config and connect
    include('../config.php');

    if(isset($_GET['order'])){
        $order = $_GET['order'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['username'])){
            $username = $_POST['username'];
        }

        function OrderSql($con, $sql){
            $query = mysqli_query($con, $sql);

            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_array($query))
                {
                    if($row['Type'] == 'income'){
                        echo "
                        <div class='col-sm-6 col-lg-4 mb-4'>
                            <div class='card income_card'>
                                <div class='card-date card-header d-flex justify-content-between align-items-center'>
                                    <div class='card-date'>$row[Date_billing]</div>
                                </div>
                                <div class='card-body d-flex justify-content-between'>
                                    <div class='card-description'>$row[Description]</div>
                                    <div calss='card-amount' style='font-weight:600'>$ $row[Money]</div>
                                </div>
                            </div>
                        </div>";
                    }else if($row['Type'] == 'expense'){
                        echo "
                        <div class='col-sm-6 col-lg-4 mb-4'>
                            <div class='card expense_card'>
                                <div class='card-date card-header d-flex justify-content-between align-items-center'>
                                    <div class='card-date'>$row[Date_billing]</div>
                                </div>
                                <div class='card-body d-flex justify-content-between'>
                                    <div class='card-description'>$row[Description]</div>
                                    <div calss='card-amount' style='font-weight:600'>$ $row[Money]</div>
                                </div>
                            </div>
                        </div>";
                    }
                }
            }else{
                echo "
                    <div>
                        <div style='text-align: center; margin: 2rem; padding: 2rem; border: 1px solid rgb(225, 223, 223); border-radius: 4px;'>
                            <h1>尚未有收入/支出的資料!</h1>
                        </div>
                    </div>
                ";
            }
        }

        if($order === 'desc'){
            $sql = "SELECT * FROM `income` WHERE Name = '$username' UNION SELECT * FROM `expense` WHERE Name = '$username' ORDER BY `Date_billing` DESC, `Time_create` DESC";
            OrderSql($con, $sql);
        }else if($order === 'asc'){
            $sql = "SELECT * FROM `income` WHERE Name = '$username' UNION SELECT * FROM `expense` WHERE Name = '$username' ORDER BY `Date_billing` ASC, `Time_create` DESC";
            OrderSql($con, $sql);
        }
    }
?>