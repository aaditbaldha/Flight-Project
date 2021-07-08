<?php


session_start();

if (isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['email'])) {
    header("location:dashboard.php");
}

require 'phpmailer/PHPMailerAutoload.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $redirect_here = false;
    $error_in_token = false;
    $token = $_POST['token'];
    $email = $_SESSION['email'];

    require "db_template.php";

    $sql = "SELECT * FROM `flight_project`.`password_recovery` WHERE `Email`='$email'";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row == NULL) {
        $error_in_token = true;
    } else {
        if (password_verify($token, $row['Token'])) {
            $error_in_token = false;
        } else
            $error_in_token = true;
    }
} else {
    $redirect_here = true;
}
if ($redirect_here == true || $error_in_token == true) {
    $atleast_one_error = true;
} else {
    $atleast_one_error = false;

    $sql = "SELECT * FROM `flight_project`.`users` WHERE `Email`='$email'";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $_SESSION['name'] = $row['Username'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['email'] = $row['Email'];
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

    </style>
</head>

<body>
    <h1>GOIVIVO </h1>
    <h2>FORGOT PASSWORD</h2>
    <h3>*WE STRONGLY RECOMMEND TO CHANGE YOUR PASSWORD AFTER VERIFICAION<h3>
            <form action=<?php if ($atleast_one_error == true) echo 'code_verification.php';
                            else header("location:dashboard.php");  ?> method="POST">
                <table border="3" cellspacing="7px" align="center" class="logintable">
                    <tr>
                        <th>ENTER THE CODE GIVEN TO EMAIL</th>
                    </tr>
                    <tr>


                        <td align="center">
                            <input type="text" name="token" placeholder="Enter otp here" required>
                        </td>



                    </tr>

                    <tr>
                        <td colspan="2" class="margin_submit"><input type="submit">
                            <input type="reset">
                        </td>
                    <tr>
                        <td><a href="signin.php"><i class="fa fa-user-plus"></i>SIGN IN</a></td>
                    </tr>
                    <tr>
                        <td><a href="login.php"><i class="fa fa-user"></i>LOGIN</a></td>
                    </tr>

                </table>
            </form>
            <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_token == true) echo "<p>YOU HAVE ENTERED WRONG TOKEN!!</p>"; ?>
</body>

</html>