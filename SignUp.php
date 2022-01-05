<?php

$errors = [];
$data = [];

$Fname = $_POST['Fname'];
$Lname = $_POST['Lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$phone = $_POST['phone'];
$street = $_POST['street'];
$city = $_POST['city'];
$country = $_POST['country'];

if (empty($Fname) or empty($Lname) or empty($email) or
empty($password) or empty($password2) or empty($phone) or empty($street)
 or empty($city) or empty($country)){
    $data['success'] = false;
    echo json_encode($data);
    return;
}

$connection = mysqli_connect('localhost','root','','registration');
if (!$connection){ return; }

$query = mysqli_query($connection,"SELECT * FROM user WHERE email='".$email."'");
$num_rows = mysqli_num_rows($query);
$data['success'] = $num_rows == 0;

if ($num_rows == 0){

    $sql = "INSERT INTO user(name, email, password) VALUES('".$name."','" . $email . "','" . md5($password) . "')";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            session_start();
            $_SESSION['sess_user'] = $name;
            $data['success'] = true;
            $data['message'] = 'Account Successfully Created !';
        } else {
            $data['success'] = false;
            $data['message'] = 'ERROR Inserting to table !';
        }
}
else{
$errors['email'] = "Email already exists";
    $data['errors'] = $errors;
    }

mysqli_close($connection);
echo json_encode($data);