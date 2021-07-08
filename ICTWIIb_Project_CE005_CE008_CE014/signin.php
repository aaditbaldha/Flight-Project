<?php

session_start();
if (isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['email'])) {
    header("location:dashboard.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $redirect_here = false;
    $not_matching_pass = false;
    $error_in_username = false;
    $email_already_exist = false;
    $username_already_exist=false;
    $error_in_fname = false;
    $error_in_lname = false;
    $error_in_email = false;


    require "db_template.php";
    $name = $_POST['Username'];
    $pass = $_POST['Password'];
    $cpass = $_POST['CPassword'];
    $fname = $_POST['Fname'];
    $email = $_POST['email'];
    $lname = $_POST['Lname'];

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ($pass != $cpass) {
        $not_matching_pass = true;
    } else {
        $not_matching_pass = false;
        if (preg_match("/^(.{0,5}|[^a-z]*|[^\d]*)$/i", $name)) {
            $error_in_username = true;
        } else if (!preg_match("/^[a-zA-Z]*$/", $fname)) {
            $error_in_fname = true;
        } else if (!preg_match("/^[a-zA-Z]*$/", $lname)) {
            $error_in_lname = true;
        } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $error_in_email = true;
        } else {

            $sql = "SELECT * FROM `flight_project`.`users` WHERE `Email`='$email'";

            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            if ($row == NULL)
                $email_already_exist = false;
            else {
                $email_already_exist = true;
            }
            $sql = "SELECT * FROM `flight_project`.`users` WHERE `Username`='$name'";

            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            if ($row == NULL)
                $username_already_exist = false;
            else {
                $username_already_exist = true;
            }

            if ($email_already_exist == false && $username_already_exist==false) {
                $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `flight_project`.`users` (`Username`, `Password`, `First Name`, `Last Name`, `Email`) VALUES ('$name', '$hash_pass', '$fname', '$lname', '$email')";
                $result = mysqli_query($con, $sql);
            }
        }
    }
} else {
    $redirect_here = true;
}

if ($redirect_here == true || $not_matching_pass == true || $username_already_exist== true || $email_already_exist == true || $error_in_username == true || $error_in_fname == true || $error_in_lname == true || $error_in_email == true) {
    $atleast_one_error = true;
} else {
    $atleast_one_error = false;
    $sql = "SELECT * FROM `flight_project`.`users` WHERE `Email`='$email'"; //email is unique for each user
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $_SESSION['name'] = $row['Username'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['email'] = $row['Email'];
    $_SESSION['enter_from'] = "signin";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<link rel="stylesheet" type="text/css" href="flight_project.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="login_signin">
       <h2 align="center">SIGN IN</h2>
    <form action=<?php if ($atleast_one_error == true) echo 'signin.php';
                    else header("location:succesful_signin.php"); ?> method="POST">
        <table border="4" align="center" class="logintable" rules="none" cellpadding="7px">
            <tr>
                <th>Username:</th>    
        <td><input type="text" name="Username" required></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><input type="password" name="Password" required></td>
            </tr>
            <tr>
                <th>Confirm Password:</th>
                    <td><input type="password" name="CPassword" required></td>
            </tr>
            <tr>
                <th>First Name:</th>
            
                <td><input type="text" name="Fname" required></td>
            </tr>
            
                <th>Last name:</th>
                            <td><input type="text" name="Lname" required></td>
            </tr>

            <tr>
                <th>Email id:</th>
                            <td><input type="email" name="email" required></td>
            </tr>

            <tr>
                <td><input type="submit"></td>
                <td><input type="reset"></td>
            </tr>
                          <tr class="bordered"></tr> 
            <tr>

                <td align="right"><a href="login.php" style="font-size:20px"> <i class="fa fa-arrow-left"></i>LOG IN</a></td>

            </tr>
        </table>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $not_matching_pass == true) echo "<p>Password and Confirm Password do not match</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $username_already_exist == true) echo "<p>Username already taken. Try choosing unique one</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $email_already_exist == true) echo "<p>User already exist try to login in</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_username == true) echo "<p>Error in username</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_fname == true) echo "<p>Error in First name</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_lname == true) echo "<p>Error in Last name</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_email == true) echo "<p>Invalid Email</p>"; ?>
</body>

</html>

