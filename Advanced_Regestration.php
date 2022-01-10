<?php

$errors = [];
$data = [];

$string = "";

$Rday = $_POST['Rday'];

if (!empty($Rday)) {

    if ($string != "") {
        $string = $string . "AND  ";
    }
    $string = $string . "res_date = '" . $Rday . "'";

}

if ($string != "") {
    $string = "WHERE " . $string;
}

$connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');

$query = mysqli_query($connection, "SELECT * FROM reservation ".$string);
$num_rows = mysqli_num_rows($query);

$i = 0;

if ($num_rows != 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $response[$i]['id'] = $row['res_id'];
        $response[$i]['cs'] = $row['customer_id'];
        $response[$i]['cr'] = $row['car_id'];
        $response[$i]['rd'] = $row['res_date'];
        $response[$i]['p'] = $row['pick_date'];
        $response[$i]['r'] = $row['return_date'];
        $response[$i]['d'] = $row['duration'];
        $data[$i] = $response[$i];
        $i += 1;
    }
}

mysqli_close($connection);
echo json_encode($data);