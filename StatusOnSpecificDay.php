<?php

$data = [];
$errors=[];
$i = 0;


$date = $_POST['s'];
if (!empty($date)) {

    if ($string != "") {
        $string = $string . "AND  ";
    }
    $string = $string . "date = '" . $date . "'";

}

if ($string != "") {
    $string = "WHERE " . $string;
}

$connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');

$query = mysqli_query($connection, "SELECT * FROM car_status ");
$num_rows = mysqli_num_rows($query);;

if($num_rows!=0)
{
    while($row=mysqli_fetch_assoc($query))
    {
		$response[$i]['id'] = $row['car_id'];
        $response[$i]['status'] = $row['status'];
        $response[$i]['date'] = $row['date'];
    
        $data[$i] = $response[$i];
        $i +=1;
    }
    session_start();
}

mysqli_close($connection);
echo json_encode($data);
