<?php

$errors = [];
$data = [];
$i = 0;
$StartDate = $_POST['StartDate'];
$EndDate = $_POST['EndDate'];
$StateDate = $_POST['StateDate'];

$connection = mysqli_connect('localhost','root','','car_rental_system');
// if (!$connection){ return; }
// $sql = "SELECT * FROM `enrolled`";
//
// $query = mysqli_query($connection,$sql);
// $num_rows = mysqli_num_rows($query);
//
// if($num_rows!=0)
// {
//     while($row=mysqli_fetch_assoc($query))
//     {
//         $response[$i]['id'] = $row['student_id'];
//         $response[$i]['cc'] = $row['course_code'];
//         $response[$i]['bb'] = $row['QUARTER'];
//         $response[$i]['dd'] = $row['year'];
//         $data[$i] = $response[$i];
//         $i +=1;
//     }
//     session_start();
// }

mysqli_close($connection);
echo json_encode($data);
