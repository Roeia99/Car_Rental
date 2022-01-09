<?php

$data = [];
$i = 0;

$string = "";

$year = $_POST['year'];
$color = $_POST['color'];
$country = $_POST['country'];
$model = $_POST['model'];
$louza = $_POST['louza'];
if(!empty($louza)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."car_id= '" . $louza . "'";

}

if($string != ""){
    $string = "WHERE ".$string;
}


$connection = mysqli_connect('localhost','root','','car_rental_system');
if (!$connection){ return; }

$sql = "SELECT * FROM `report3` $string ";
$query = mysqli_query($connection,$sql);
$num_rows = mysqli_num_rows($query);

if($num_rows!=0)
{
    while($row=mysqli_fetch_assoc($query))
    {
       // $response[$i]['r_id'] = $row['res_id'];
		$response[$i]['id'] = $row['car_id'];
        $response[$i]['m'] = $row['model'];
        $response[$i]['y'] = $row['year'];
        $response[$i]['c'] = $row['color'];
		$response[$i]['s'] = $row['status'];
		$response[$i]['o'] = $row['off_id'];
		$response[$i]['p'] = $row['price_per_day'];
        $data[$i] = $response[$i];
        $i +=1;
    }
    session_start();
}

mysqli_close($connection);
echo json_encode($data);
