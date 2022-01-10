<?php

$data = [];
$i = 0;

$string = "";

$year = $_POST['year'];
$color = $_POST['color'];
$model = $_POST['model'];
$status = $_POST['status'];
$louza = $_POST['louza'];
$start =$_POST['start'];
$end =$_POST['end'];


if(!empty($start)&& !empty($end)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."res_date >= '" . $start . "'AND res_date <= '" . $end . "'";

}


if(!empty($year)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."year= '" . $year . "'";

}

if(!empty($color)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."color= '" . $color . "'";

}

if(!empty($model)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."model= '" . $model . "'";

}



if(!empty($status)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."status= '" . $status . "'";

}


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
        $response[$i]['rid'] = $row['res_id'];
		$response[$i]['cid'] = $row['customer_id'];
		$response[$i]['res'] = $row['res_date'];
		$response[$i]['pick'] = $row['pick_date'];
		$response[$i]['return'] = $row['return_date'];
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
