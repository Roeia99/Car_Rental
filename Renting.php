<?php

$errors = [];
$data = [];
$i = 0;
$MaxPrice = $_POST['MaxPrice'];
$MinPrice = $_POST['MinPrice'];

$connection = mysqli_connect('localhost','root','','course_regiseration');
if (!$connection){ return; }
$sql = "SELECT * FROM `enrolled`";

$query = mysqli_query($connection,$sql);
$num_rows = mysqli_num_rows($query);

if($num_rows!=0)
{
    while($row=mysqli_fetch_assoc($query))
    {
        $response[$i]['id'] = $row['student_id'];
        $response[$i]['cc'] = $row['course_code'];
        $response[$i]['bb'] = $row['QUARTER'];
        $response[$i]['dd'] = $row['year'];
        $data[$i] = $response[$i];
        $i +=1;
    }
    session_start();
}

mysqli_close($connection);
echo json_encode($data);
