<?php


session_start();

if (isset($_SESSION['name']) && isset($_SESSION['id']) && isset($_SESSION['email'])) {
    header("location:dashboard.php");
}

require 'phpmailer/PHPMailerAutoload.php';
require "db_template.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
    $redirect_here = false;
    $error_in_token = false;
    $token=$_POST['token'];
    $email=$_SESSION['email_of_card_holder'];

    
    $sql = "SELECT * FROM `flight_project`.`payment` WHERE `Email`='$email'";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row==NULL)
    {
        $error_in_token=true;
    }
    else
    {
        if (password_verify($token, $row['Token'])) {
            $error_in_token = false;
        }
        
        else
            $error_in_token=true;
    }


    
} else {
    $redirect_here = true;
}
if($redirect_here==true || $error_in_token==true)
{
    $atleast_one_error=true;
}
else
{
    $atleast_one_error=false;
    
    /*$sql = "SELECT * FROM `flight_project`.`users` WHERE `Email`='$email'";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    $_SESSION['name'] = $row['Username'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['email'] = $row['Email'];*/

    


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
    
    <form action=<?php if ($atleast_one_error == true) echo 'payment_verification.php';
                    else header("location:final_page.php");  ?> method="POST">
        <table border="4" class="logintable" align="center" cellspacing="7px">
            <tr>
                <th colspan="3">Enter The Code Given To Email</th>
            </tr>
            
            <tr>
                <td align="center" colspan="3"><input type="text" name="token" placeholder="Enter the Code Here" required></td>
            </tr>
            <tr>
                <td colspan="3" align="center"><input type="submit">
            
                <input type="reset"></td>
            </tr>
                <tr class="bordered"></tr>
            <tr>
                <td><a href="signin.php"><i class="fa fa-user-plus"></i> SIGN IN</a></td> 
                 <td><a href="payment.php"><i class="fa fa-arrow-left"></i> GO BACK</a></td>

                   

        </table>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && $error_in_token == true) echo "<p>YOU HAVE ENTERED WRONG TOKEN!!</p>"; ?>
</body>

</html>