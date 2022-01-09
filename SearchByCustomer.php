<?php


function console_log($output, $with_script_tags = true)
{
 $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
 if ($with_script_tags) {
 $js_code = '<script>' . $js_code . '</script>';
 }
 echo $js_code;
}



$errors = [];
$data = [];

$string = "";

$Fname = $_POST['Fname'];
$Lname = $_POST['Lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$street = $_POST['street'];
$city = $_POST['city'];
$country = $_POST['country'];

if(!empty($Fname)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."first_name= '" . $Fname . "'";

}

if(!empty($Lname)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."last_name= '" . $Lname . "'";

}

if(!empty($email)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."email= '" . $email . "'";

}

if(!empty($phone)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."phone_no= '" . $phone . "'";

}

if(!empty($street)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."Street_name= '" . $street . "'";

}

if(!empty($city)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."city= '" . $city . "'";

}

if(!empty($country)){

    if($string != ""){
    $string = $string."AND  ";
    }
    $string = $string."country= '" . $country . "'";

}

if($string != ""){
    $string = "WHERE ".$string;
}
console_log($string);

$connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');
if (!$connection) {
    return;
}

$query = mysqli_query($connection, "SELECT * FROM report4 $string");
$num_rows = mysqli_num_rows($query);

console_log($num_rows);

if($num_rows!=0)
{
    while($row=mysqli_fetch_assoc($query))
    {
        $response[$i]['id'] = $row['customer_id'];
        $response[$i]['fn'] = $row['first_name'];
        $response[$i]['ln'] = $row['last_name'];
        $response[$i]['ci'] = $row['car_id'];
        $response[$i]['m'] = $row['model'];
        $response[$i]['pd'] = $row['pay_date'];
        $response[$i]['tp'] = $row['total_pay'];
        $data[$i] = $response[$i];
        $i +=1;
    }
    session_start();
}

mysqli_close($connection);
echo json_encode($data);