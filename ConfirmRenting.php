<?php
$errors = [];
$data = [];
// $PickupDate = $_POST['PickupDate'];
// $ReturnDate = $_POST['ReturnDate'];

// $carId = $_SESSION['carId'];
$data ['ss'] = "mohamed"; 

$connection = mysqli_connect('localhost','root','','car_rental_system');
if (!$connection){ return; }
$query = mysqli_query($connection,"SELECT * FROM car  NATURAL JOIN office WHERE car_id='".$carId."'");
$num_rows = mysqli_num_rows($query);
if($num_rows!=0)
{
    $row=mysqli_fetch_assoc($query)

    $data['model'] = $row['model'];
    $data['year'] = $row['year'];
    $data['color'] = $row['color'];
    $data['price'] = $row['price_per_day']
    $data['officeName'] = $row['name'];
    $data['officeCountry'] = $row['country'];
    $data['officeCity'] = $row['city'];
       
        

}
}

mysqli_close($connection);
echo json_encode($data);
// echo json_decode()
