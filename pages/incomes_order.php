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
                    echo "
                        <div class='col-sm-6 col-lg-4 mb-4'>
                            <div class='card income_card $row[Month]' id='$row[ID]' data-month='$row[Month]'>
                                <div class='card-date card-header d-flex justify-content-between align-items-center'>
                                    <div class='card-date'>$row[Date_billing]</div>
                                    <div class='btn-group'>
                                        <div class='edit-card card-btn' onclick='editCard($row[ID])'>
                                            <a href='#'>編輯</a>
                                        </div>
                                        <div class='delete-card card-btn' onclick='deleteCard(1,$row[ID])'>
                                            <a href='#'>刪除</a>
                                        </div> 
                                    </div>
                                </div>
                                <div class='card-body d-flex justify-content-between'>
                                    <div class='card-description'>$row[Description]</div>
                                    <div calss='card-amount' style='font-weight:600'>$ $row[Money]</div>
                                </div>
                            </div>
                        </div>";
                }
            }else{
                echo "
                    <div>
                        <div class='no-income'>
                            <h1>尚未有收入的資料!</h1>
                        </div>
                    </div>
                ";
            }
        }

        if($order === 'desc'){
            $sql = "SELECT * FROM `income` WHERE Name = '$username' ORDER BY `Date_billing` DESC , `Time_create` DESC";
            OrderSql($con, $sql);
        }else if($order === 'asc'){
            $sql = "SELECT * FROM `income` WHERE Name = '$username' ORDER BY `Date_billing` ASC , `Time_create` DESC";
            OrderSql($con, $sql);
        }
    }
?>