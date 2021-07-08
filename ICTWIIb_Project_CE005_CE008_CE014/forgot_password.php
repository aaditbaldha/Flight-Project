<?php


session_start();

if (isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['email'])) {
    header("location:dashboard.php");
}

require 'phpmailer/PHPMailerAutoload.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $redirect_here = false;
    $error_in_email = false;
    $email=$_POST['email'];


    require "db_template.php";
    
    $sql = "SELECT * FROM `flight_project`.`users` WHERE `Email`='$email'";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row==NULL)
    {
        $error_in_email=true;
    }
    else
    {
        $error_in_email=false;
    }


    
} else {
    $redirect_here = true;
}
if($redirect_here==true || $error_in_email==true)
{
    $atleast_one_error=true;
}
else
{
    $atleast_one_error=false;
    $_SESSION['email']=$email;

    $token=rand(10000,100000);
    $hash_token=password_hash($token, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM `flight_project`.`password_recovery` WHERE `Email`='$email'";
    
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);


    if($row==NULL)
    {
        $email_present=false;
    }
    else
    {
        $email_present=true;
    }

    if($email_present==true)
    {
        $sql="UPDATE `flight_project`.`password_recovery` SET `Token` ='$hash_token' WHERE `Email`='$email'";
        $result = mysqli_query($con, $sql);
    }
    else
    {
        $sql="INSERT INTO `flight_project`.`password_recovery` (`Email`, `Token`) VALUES ('$email', '$hash_token')";
        $result = mysqli_query($con, $sql);
    }



      
    $message = $token;


    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = 'goivivoteam@gmail.com';
    $mail->Password = '005008014';

    $mail->setFrom('goivivoteam@gmail.com');
    $mail->addAddress('aaditbaldha2002@gmail.com');
    $mail->addReplyTo('goivivoteam@gmail.com');

    $mail->Subject = 'PAYMENT VERIFICATION TOKEN';
    $mail->Body = $message;

    $mail->send();




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

<body>
    <h1>GOIVIVO </h1>
    <h2>FORGOT PASSWORD</h2>
    <form action=<?php if ($atleast_one_error == true) echo 'forgot_password.php';
                    else header("location:code_verification.php");  ?> method="POST">
        <table border="4" cellspacing="7px" align="center" class="logintable">
            <tr>
                <th>ENTER YOUR EMAIL ID</th>
            </tr>
            <tr>

                <td><input type="email" name="email" required></td>
            </tr>
            <tr class="margin_submit">
                <td><input type="submit">
                <input type="reset"></td>
            </tr>
            <tr>
                <td><a href="signin.php"><i class="fa fa-user-plus"></i>SIGN IN</a></td>
            </tr>
            <tr>
                <td><a href="login.php"><i class="fa fa-user"></i>LOGIN IN</a></td>
            </tr>

        </table>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_email == true) echo "<p>THIS EMAIL DOES NOT EXIST!!</p>"; ?>
</body>

</html>