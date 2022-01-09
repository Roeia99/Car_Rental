<?php

$errors = [];
$data = [];

$Fname = $_POST['Fname'];
$Lname = $_POST['Lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$street = $_POST['street'];
$city = $_POST['city'];
$country = $_POST['country'];

if(!empty($Fname)){

}


$connection = mysqli_connect('localhost', 'root', '', 'car_rental_system');
if (!$connection) {
    return;
}

$query = mysqli_query($connection, "SELECT * FROM report4 WHERE email='" . $email . "'");
$num_rows = mysqli_num_rows($query);
$data['success'] = $num_rows == 0;

if ($num_rows == 0) {

    $sql = "INSERT INTO customer(first_name,
                                last_name,
                                Street_name,
                                city,
                                country,
                                email,
                                `password`,
                                phone_no)
                                VALUES(
                                '" . $Fname . "',
                                '" . $Lname . "',
                                '" . $street . "',
                                '" . $city . "',
                                '" . $country . "',
                                '" . $email . "',
                                '" . md5($password) . "',
                                '" . $phone . "'
                                )";

    $result = mysqli_query($connection, $sql);
    if ($result) {
        session_start();
        $_SESSION['sess_user'] = $Fname;
        $data['success'] = true;
        $data['message'] = 'Account Successfully Created !';
    } else {
        $data['success'] = false;
        $data['message'] = 'ERROR Inserting to table !';
    }
} else {
    $errors['email'] = "Email already exists";
    $data['errors'] = $errors;
}

mysqli_close($connection);
echo json_encode($data);