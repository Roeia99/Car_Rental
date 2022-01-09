<?php

$data = [];
$i = 0;

$MaxPrice = $_POST['MaxPrice'];
$MinPrice = $_POST['MinPrice'];
$year = $_POST['year'];
$color = $_POST['color'];
$country = $_POST['country'];
$model = $_POST['year'];

$connection = mysqli_connect('localhost','root','','car_rental_system');

$condition = '';

$sql = "SELECT * FROM `car`";

$query = mysqli_query($connection,$sql);
$num_rows = mysqli_num_rows($query);

if($num_rows!=0)
{
    while($row=mysqli_fetch_assoc($query))
    {
        $response[$i]['id'] = $row['car_id'];
        $response[$i]['model'] = $row['model'];
        $response[$i]['year'] = $row['year'];
        $response[$i]['color'] = $row['color'];
        $response[$i]['ppd'] = $row['price_per_day'];
        $data[$i] = $response[$i];
        $i +=1;
    }
}

mysqli_close($connection);
echo json_encode($data);
