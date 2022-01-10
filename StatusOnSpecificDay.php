<?php

$data = [];
$i = 0;


$date = $_POST['s'];


$connection = mysqli_connect('localhost','root','','car_rental_system');

$sql = "SELECT * FROM car_status WHERE `date` = '".$date."'";

$query = mysqli_query($connection,$sql);
$num_rows = mysqli_num_rows($query);

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
