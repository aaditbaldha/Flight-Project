<?php

session_start();

/*if (isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['email'])) {
    header("location:dashboard.php");
}*/

require "db_template.php";

$email = $_SESSION['email'];

$sql = "SELECT * FROM `flight_project`.`users` WHERE `Email`='$email'";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);



$display_username = $row['Username'];
$display_first_name = $row['First Name'];
$display_last_name = $row['Last Name'];
$display_email = $row['Email'];


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $redirect_here = false;
    $not_matching_pass = false;
    $error_in_username = false;
    $username_already_exist = false;
    $error_in_fname = false;
    $error_in_lname = false;




    $new_name = $_POST['NUsername'];
    $new_pass = $_POST['NPassword'];
    $new_cpass = $_POST['NCPassword'];
    $new_fname = $_POST['NFname'];
    $new_lname = $_POST['NLname'];


    if ($new_pass != $new_cpass) {
        $not_matching_pass = true;
    } else {
        $not_matching_pass = false;
        if (preg_match("/^(.{0,7}|[^a-z]*|[^\d]*)$/i", $new_name)) {
            $error_in_username = true;
        } else if (!preg_match("/^[a-zA-Z]*$/", $new_fname)) {
            $error_in_fname = true;
        } else if (!preg_match("/^[a-zA-Z]*$/", $new_lname)) {
            $error_in_lname = true;
        } else {

            $sql = "SELECT * FROM `flight_project`.`users` WHERE `Username`='$new_name'";

            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            if ($row == NULL)
                $username_already_exist = false;
            else {
                $username_already_exist = true;
            }

            if ($new_name == $display_username)
                $username_already_exist = false;

            if ($username_already_exist == false) {
                $hash_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                $sql = "UPDATE `flight_project`.`users` SET `Username` ='$new_name', `Password`='$hash_pass', `First Name`='$new_fname', `Last Name`='$new_lname' WHERE `Email`='$email'";
                $result = mysqli_query($con, $sql);
            }
        }
    }
} else {
    $redirect_here = true;
}

if ($redirect_here == true || $not_matching_pass == true || $username_already_exist == true || $error_in_username == true || $error_in_fname == true || $error_in_lname == true) {
    $atleast_one_error = true;
} else {
    $atleast_one_error = false;
    $sql = "SELECT * FROM `flight_project`.`users` WHERE `Email`='$email'"; //email is unique for each user
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $_SESSION['name'] = $row['Username'];
    $_SESSION['id'] = $row['ID'];
    $_SESSION['email'] = $row['Email'];
    $_SESSION['enter_from'] = "change_details";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="flight_project.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Login</title>

</head>

<body style="background-color: lavender;">
    <h1>GOIVIVO </h1>
    <h4 align="center">EXISTING DETAILS</h4>


    <table border="4" style =" background-color: #a6bed9;" align="center">
        <tr>
            <th>Username:</th>
            <td><?php echo $display_username; ?></td>
        </tr>
        <tr>
            <th>First Name:</th>
            <td><?php echo $display_first_name; ?></td>
        </tr>
        <tr>
            <th>Last name :</th>
            <td><?php echo $display_last_name; ?></td>
        </tr>
        <tr>
            <th>Email :</th>
            <td><?php echo $display_email; ?></td>
        </tr>
    </table>
    <h4 align="center">NEW DETAILS</h4>
    <table>
        <tr class="bordered"></tr>
    </table>
    <form action="change_details.php" method="POST">
        <table border="4" style =" background-color: #a6bed9;" align="center">
            <tr>
                <th>New Username:</th>
                <td><input type="text" name="NUsername" required minlength="4" maxlength="15"></td>
            </tr>
            <tr>
                <th>New Password:</th>
                <td><input type="password" name="NPassword" required minlength="4" maxlength="15"></td>
            </tr>
            <tr>
                <th>Confirm Password:</th>
                <td><input type="password" name="NCPassword" required minlength="4" maxlength="15"></td>
            </tr>
            <tr>
                <th>First Name:</th>
                <td><input type="text" name="NFname" required minlength="4" maxlength="15"></td>
            </tr>
            <tr>
                <th>Last name:</th>
                <td><input type="text" name="NLname" required minlength="4" maxlength="15"></td>
            </tr>

            <tr>
                <td><input type="submit"></td>
                <td><input type="reset"></td>
            </tr>
            <tr>
                <td><a href="dashboard.php">GO TO DASHBOARD <i class="fa fa-arrow-right"></i></a></td>
            </tr>

        </table>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $not_matching_pass == true) echo "<p>Password and Confirm Password do not match</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $username_already_exist == true) echo "<p>Username already taken. Try choosing unique one</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_username == true) echo "<p>Username should contain atleast one digit and 8 characters</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_fname == true) echo "<p>Error in First name</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_lname == true) echo "<p>Error in Last name</p>"; ?>
</body>

</html>