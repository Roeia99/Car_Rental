<?php

$data = [];
$i = 0;

$string = "";

$Sdate = $_POST['Sdate'];
$Edate = $_POST['Edate'];

$connection = mysqli_connect('localhost','root','','car_rental_system');

if (!empty($Sdate) && !empty($Edate) {

    $string = $string."WHERE res_date >= '" . $Sdate . "' AND res_date <= '" . $Edate . "'";

}


$sql = "SELECT * FROM report1 $string";

$query = mysqli_query($connection,$sql);
$num_rows = mysqli_num_rows($query);

if($num_rows!=0)
{
    while($row=mysqli_fetch_assoc($query))
    {
		$response[$i]['id'] = $row['res_id'];
        $response[$i]['cid'] = $row['customer_id'];
        $response[$i]['fn'] = $row['first_name'];
        $response[$i]['ln'] = $row['last_name'];
        $response[$i]['e'] = $row['email'];
        $response[$i]['phn'] = $row['phone_no'];
        $response[$i]['st'] = $row['Street_name'];
        $response[$i]['ct'] = $row['city'];
        $response[$i]['ctr'] = $row['country'];
		$response[$i]['cr'] = $row['car_id'];
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
