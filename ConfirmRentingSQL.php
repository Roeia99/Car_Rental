<?php>
    $data = [];
    $errors = [];

    $customer_id = $_POST['customer_id'];
    $car_id = $_POST['car_id'];
    $pickupDate = $_POST['PickupDate'];
    $returnDate = $_POST['ReturnDate'];
    
    $query = mysqli_query($connection, "SELECT * FROM reservation WHERE car_id ='" . $CarID . "' 
                            AND customer_id = '".$customer_id."' AND (pick_date = '".$pickupDate."'");
    $num_rows = mysqli_num_rows($query);
    $data['success'] = $num_rows == 0;
    if ($num_rows == 0) {

        $sql ="INSERT INTO reservation(customer_id,car_id,pick_date,return_date) 
                VALUES ('".$customer_id."','".$car_id."','".$pickupDate."','".$returnDate."')" ;


    $result = mysqli_query($connection, $sql);
    if ($result) {
        $data['success'] = true;
        $data['message'] = 'RESERVED !';
    } else {
        $data['success'] = false;
        $data['message'] = 'ERROR Inserting to table !';
        }
    }