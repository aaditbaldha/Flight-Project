<?php

session_start();
if (isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['email']) ) {
    header("location:dashboard.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $redirect_here = false;
    $error_in_credatials = false;
    $error_in_username = false;
    $error_in_pass = false;


    require "db_template.php";
    $name = $_POST['Username'];
    $pass = $_POST['Password'];




    if (!preg_match("/^[a-zA-Z0-9_.-]*$/", $name)) 
    {
        
        $error_in_username = true;
    } else {

        $error_in_username = false;
        $sql = "SELECT * FROM `flight_project`.`users` WHERE `Username`='$name'";

        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);

        if ($row == NULL)
            $error_in_credatials = true;
        else {
            $error_in_credatials = false;
        }

        if ($error_in_credatials == false) {
            if (password_verify($pass, $row['Password'])) {
                $error_in_pass = false;
            } else
                $error_in_pass = true;
        }
        if ($error_in_pass == true)
            $error_in_credatials = true;
    }
} else {
    $redirect_here = true;
}
if ($redirect_here == true || $error_in_credatials == true || $error_in_username == true) {
    $atleast_one_error = true;
} else {
    $atleast_one_error = false;
    $_SESSION['name'] = $row['Username'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['email'] = $row['Email'];
    $_SESSION['enter_from'] = "login";
}
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
  <link rel="stylesheet" href="flight_project.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="login_signin">
        <h2 align="center">LOG IN</h2>
    <form action=<?php if ($atleast_one_error == true) echo 'login.php';
                    else header("location:dashboard.php"); ?> method="POST">
        <table  align="center" class="logintable" rules="none" cellpadding="7px">
            <tr>
                <th colspan="2">Username:</th>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="text" name="Username" required></td>
            </tr>
            <tr>
                <th colspan="2">Password:</th>
            </tr>
            <tr>
                <td colspan="2 " align="center"><input type="password" name="Password" required></td>
            </tr>
            <tr>
                <td align=""><input type="submit"></td>
                <td><input type="reset"></td>
            </tr>
            <tr>
              <tr class="bordered"></tr> 
                <td> <a href="signin.php"style="font-size:20px"><i class="fa fa-user-plus"></i>Sign in</a></td>
                <td><a href="forgot_password.php" style="font-size:20px"> <i class="fa fa-key"></i>Forget Password</a></td>

            </tr>
        </table>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_credatials == true) echo "<p>Invalid Credantials</p>";
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_username == true) echo "<p>Username is invalid</p>"; ?>
</body>

</html>