<?php

$errors = [];
$data = [];

$CarID = $_POST['CarID'];
$Model = $_POST['Model'];
$Year = $_POST['Year'];
$Color = $_POST['Color'];
$Status = $_POST['Status'];
$Office = $_POST['Office'];
$PricePerDay = $_POST['PricePerDay'];


if (empty($CarID) or empty($Model)
    or empty($Year) or empty($Color)
    or empty($Status) or empty($Office)
    or empty($PricePerDay)) {
    $data['success'] = false;
    alert("Something is missing");
    echo json_encode($data);
    return;
}

$connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');
if (!$connection) {
    return;
}

$query = mysqli_query($connection, "SELECT * FROM car WHERE car_id ='" . $CarID . "'");
$num_rows = mysqli_num_rows($query);
// console.log($num_rows);
$data['success'] = $num_rows == 0;

if ($num_rows == 0) {

    $sql = "INSERT INTO car (car_id,
                                model,
                                year,
                                color,
                                `status`,
                                off_id,
                                is_reserved,
                                price_per_day)
                                VALUES(
                                '" . $CarID . "',
                                '" . $Model . "',
                                '" . $Year . "',
                                '" . $Color . "',
                                '" . $Status . "',
                                '" . $Office . "',
                                     'false',
                                '" . $PricePerDay.  "'
                                )";


    $result = mysqli_query($connection, $sql);
    if ($result) {
        $data['success'] = true;
        $data['message'] = 'Car Inserted Successfully !';
    } else {
        $data['success'] = false;
        $data['message'] = 'ERROR Inserting to table !';
        }
    }else{
    $data['success'] = false;
    $data['message'] = 'This Car is already in the system';
    }


mysqli_close($connection);
echo json_encode($data);