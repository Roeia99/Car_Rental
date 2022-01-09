<!-- ---- Include the above in your HEAD tag -------- -->

<!DOCTYPE html>
<html>

<head>
    <title>Confirm Renting Page</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
            integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
            crossorigin="anonymous"></script>

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="ConfirmRenting.js"></script>

</head>


<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card" style="width: 60rem;height: 28rem;">
            <div class="card-header">
                <h3>Rent your car</h3>
            </div>
            <div class="card-body">
                <form action="ConfirmRenting.php" method="POST">
                    <!-- car Information-->
                    <div class="row">
                        <!-- car Information Col-->
                        <div class="col">
                            <div class="card-header">
                                <h3>car Information</h3>
                            </div>
                            <!--                            Information-->
                            <div class="card text-white bg-primary mb-3"
                                 style="width: 33rem;height: 15rem;overflow: auto;">
                                <div class="card-body text-white">
                                    <div class="container-fluid">
                                        <?php

                                        function console_log($output, $with_script_tags = true)
                                        {
                                            $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
                                            if ($with_script_tags) {
                                                $js_code = '<script>' . $js_code . '</script>';
                                            }
                                            echo $js_code;
                                        }

                                        session_start();

                                        console_log("Logging in !");
                                        console_log($_SESSION);
                                        console_log($_POST);
                                        console_log($_GET);


                                        $errors = [];
                                        $data = [];

                                        $PickupDate = $_SESSION['PickupDate'];
                                        $ReturnDate = $_SESSION['ReturnDate'];
                                        $carId = $_SESSION['carId'];

                                        //                                        $PickupDate = "22/4/2022";
                                        //                                        $ReturnDate = "24/4/2022";
                                        //                                        $carId = "mm111";
                                        $connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');

                                        $query = mysqli_query($connection, "SELECT * FROM car  NATURAL JOIN office WHERE car_id='" . $carId . "'");
                                        $num_rows = mysqli_num_rows($query);                                                // echo "<div class="mt-2 remember"><label  style="font-size: 22px">Year:</label> <label id="year" style="font-size: 22px">Y</label></div>";
                                        $row = mysqli_fetch_assoc($query);

                                        echo "<div class=\"mt-2 remember\">
                                                    <label  style=\"font-size: 22px\">CAR ID:</label> 
                                                    <label id=\"model\" style=\"font-size: 22px\">" . $carId . "</label>
                                                    </div>";
                                        // if($num_rows!=0)
                                        echo "<div class=\"mt-2 remember\">
                                                    <label  style=\"font-size: 22px\">Model:</label> 
                                                    <label id=\"model\" style=\"font-size: 22px\">" . $row['model'] . "</label>
                                                    </div>";
                                        echo "<div class=\"mt-2 remember\">
                                                    <label  style=\"font-size: 22px\">Year:</label>
                                                    <label id=\"year\" style=\"font-size: 22px\">" . $row['year'] . "</label></div>";
                                        echo "<div class=\"mt-2 remember\">
                                                    <label  style=\"font-size: 22px\">price/day:</label>
                                                    <label id=\"price_day\" style=\"font-size: 22px\">" . $row['price_per_day'] . "</label></div>";
                                        echo "<div class=\"mt-2 remember\">
                                                      <label style=\"font-size: 22px\">Color:</label> 
                                                      <label id=\"color\" style=\"font-size: 22px\">" . $row['color'] . "</label></div>";
                                        echo "<div class=\"mt-2 remember\">
                                                     <label style=\"font-size: 22px\">Office name:</label> 
                                                     <label id=\"office_name\" style=\"font-size: 22px\">" . $row['name'] . "</label></div>";
                                        echo " <div class=\"mt-2 remember\">
                                                      <label   style=\"font-size: 22px\">Office Location:</label> 
                                                      <label id=\"Office_location\" style=\"font-size: 22px\">" . $row['country'] . "</label></div>";

                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Additional needed Data Col-->
                        <div class="col-sm-5">
                            <div class="input-group form-group">
                                <div class="form-group">
                                    <div class="card-header">
                                        <h3>Payment details</h3>
                                    </div>
                                    <div class="mt-2 remember">
                                        <span style="padding-right: 7em">Pick date</span>Return date
                                    </div>
                                    <div class="mt-2 input-group form-group">
                                        <!-- to do put the pickup and return -->
                                        <?php
                                        $PickupDate = $_SESSION['PickupDate'];
                                        $ReturnDate = $_SESSION['ReturnDate'];
                                        echo " <div class=\"mt-2 remember\">
                                        <span style=\"padding-right: 7em\">
                                        " . $PickupDate . "
                                        </span>" . $ReturnDate . "
                                        </div>";
                                        ?>
                                    </div>

                                    <div class="mt-2 remember">
                                        <label style="font-size: 22px">Pay Date:</label>
                                        <label id="Pay_Date"
                                               style="font-size: 22px">Pay
                                            Date:</label>
                                    </div>

                                    <div class="mt-2 remember">
                                        <label style="font-size: 22px">Total
                                            Price:</label><label id="Total_Price" style="font-size: 22px">Total
                                            Price:</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 form-group">
                                <input id="confirm" type="submit" value="Confirm and Check out" style="width: 250px"
                                       class="btn float-right login_btn">
                            </div>
                        </div>
                    </div>
            </div>
            </form>
            <div class="card-footer">
                <div class="d-flex  justify-content-left links">
                    <a href="homepage.html">Sign Out</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>








