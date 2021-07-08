<?php


session_start();

if (isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['email'])) {
    header("location:dashboard.php");
}

require 'phpmailer/PHPMailerAutoload.php';
require "db_template.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $redirect_here = false;
    
    $error_in_card_num=false;
    $error_name_in_card=false;
    /*$error_in_expiry_date=false;*/
    $error_in_cvv=false;
    $error_in_email = false;
    
    $card_name=$_POST['card_name'];
    $card_num=$_POST['card_number'];
    $card_date=$_POST['card_date'];
    $cvv=$_POST['cvv'];
    $email = $_POST['email_of_card_holder'];
    
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    
    
    if (!preg_match("/^[a-zA-Z]*$/", $card_name)) {
        $error_in_card_name = true;

    } else if (!preg_match("/^[0-9]*$/", $card_num)) {
        $error_in_card_num = true;

    } else if (!preg_match("/^[0-9]*$/", $cvv)) {
        $error_in_cvv = true;

    } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $error_in_email = true;
    }

} else {
    $redirect_here = true;
}
if ($redirect_here == true || $error_in_email == true  || $error_in_card_num==true || $error_name_in_card==true || $error_in_expiry_date==true || $error_in_cvv==true) {
    $atleast_one_error = true;
} else {
    
    $atleast_one_error = false;
    $_SESSION['email_of_card_holder'] = $email;

    
    

    $token = rand(10000, 100000);
    $hash_token=password_hash($token, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM `flight_project`.`payment` WHERE `Email`='$email'";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);


    if ($row == NULL) {
        $email_present = false;
    } else {
        $email_present = true;
    }

    if ($email_present == true) {
        $sql = "UPDATE `flight_project`.`payment` SET `Token` ='$hash_token' WHERE `Email`='$email'";
        $result = mysqli_query($con, $sql);
    } else {
        $sql = "INSERT INTO `flight_project`.`payment` (`Email`, `Token`) VALUES ('$email', '$hash_token')";
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
    $mail->addAddress($_POST['email_of_card_holder']);
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
    <title>Login</title>
    <link rel="stylesheet" href="flight_project.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <h1>GOIVIVO </h1>
    <h2>Payment</h2>
    <form action=<?php if ($atleast_one_error == true) echo 'payment.php';
                    else header("location:payment_verification.php");  ?> method="POST">
        <table border="4" class="logintable" align="center">
            <tr>
                <th>Card number</th>
                <td><input type="text" name="card_number" required  title="It should only have number and of 12 digits" pattern="\d{12}"></td>
            </tr>
            <tr>
                <th>Name on card</th>
                <td><input type="text" name="card_name" required min="3" max="20"></td>
            </tr>
            <tr>
                <th>Expiry Date</th>
                <td><input type="date" name="card_date" required min="2021-07-05"></td>
            </tr>
            <tr>
                <th>Enter CVV</th>
                <td><input type="text" name="cvv" title="It should only have number and of 3 digits" pattern="\d{3}"></td>
            <tr>
                <th>Enter Email</th>
                <td><input type="email" name="email_of_card_holder" required min="12" max="12"></td>
            </tr>
            <tr>
                <td><a href="view_plane.php"><i class="fa fa-arrow-left"></i> GO BACK</a></td>
                <td align="right"><input type="submit" value="submit">
            </tr>

        </table>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_card_name == true) echo "<p>INVALID CARD NAME</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_card_num == true) echo "<p>INVALID CARD NUMBER</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_cvv == true) echo "<p>INVALID CVV</p>";
    else if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_email == true) echo "<p>INVALID EMAIL</p>"; ?>
</body>

</html>