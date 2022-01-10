<?php

$data = [];
$i = 0;

$MaxPrice = $_POST['MaxPrice'];
$MinPrice = $_POST['MinPrice'];

$year = $_POST['year'];
$color = $_POST['color'];
$model = $_POST['model'];
$country = $_POST['country'];

$StartDate = $_POST['StartDate'];
$EndDate = $_POST['EndDate'];

$string = '';

if (!empty($MinPrice)) {
    if ($string != "") {
        $string = $string . "AND  ";
    }
    $string = $string . "price_per_day>= '" . $MinPrice . "'";
}

if (!empty($MaxPrice)) {
    if ($string != "") {
        $string = $string . "AND  ";
    }
    $string = $string . "price_per_day<= '" . $MaxPrice . "'";
}

if (!empty($year)) {
    if ($string != "") {
        $string = $string . "AND  ";
    }
    $string = $string . "year= '" . $year . "'";
}

if (!empty($color)) {
    if ($string != "") {
        $string = $string . "AND  ";
    }
    $string = $string . "color= '" . $color . "'";
}

if (!empty($model)) {
    if ($string != "") {
        $string = $string . "AND  ";
    }
    $string = $string . "model= '" . $model . "'";
}

if (!empty($StartDate) && !empty($EndDate)) {
    if ($string != "") {
        $string = $string . "AND  ";
    }
    $CarsInPeriod =
        " 
            SELECT DISTINCT
            car_id
            FROM
            reservation
            WHERE ( '".$StartDate."'  BETWEEN pick_date AND return_date ) OR
             ( '".$EndDate."' BETWEEN pick_date AND return_date)
        ";
    $string = $string . "car_id NOT IN (".$CarsInPeriod.")";
}

$connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');

if ($string != "") {
    $string = "WHERE " . $string;
}

$sql = "SELECT * FROM `car` " . $string;

$query = mysqli_query($connection, $sql);
$num_rows = mysqli_num_rows($query);

if ($num_rows != 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $response[$i]['id'] = $row['car_id'];
        $response[$i]['model'] = $row['model'];
        $response[$i]['year'] = $row['year'];
        $response[$i]['color'] = $row['color'];
        $response[$i]['ppd'] = $row['price_per_day'];
        $data[$i] = $response[$i];
        $i += 1;
    }
}

mysqli_close($connection);
echo json_encode($data);
