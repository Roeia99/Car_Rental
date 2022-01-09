<?php

$errors = [];
$data = [];

$CarID = $_POST['CarID'];
$Status = $_POST['Status'];


$connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');
if (!$connection) {
    return;
}

$query = mysqli_query($connection, "SELECT * FROM car WHERE car_id ='" . $CarID . "'");
$num_rows = mysqli_num_rows($query);
$data['success'] = $num_rows == 1;


if ($num_rows != 0) {

    $sql = "UPDATE car SET status = '" . $Status . "' WHERE car_id = '" . $CarID . "' ";

    $result = mysqli_query($connection, $sql);

        if ($result) {
            $data['success'] = true;
            $data['message'] = 'Car Status Updated Successfully !';
        }
        else {
            $data['success'] = false;
            $data['message'] = 'ERROR Inserting to table !';
            }
}
else{
$data['success'] = false;
$data['message'] = 'This Car is not in the System';
}

mysqli_close($connection);
echo json_encode($data);