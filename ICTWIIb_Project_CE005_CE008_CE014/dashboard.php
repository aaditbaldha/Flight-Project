<?php


session_start();
if (isset($_SESSION['name'])==false && isset($_SESSION['id'])==false && isset($_SESSION['email'])==false) {
    header("location:login.php");
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

<body style="background-color: lavender;" class="dashboard">
    <h2 align="center">DASHBOARD</h2>
    <h1 align="center"><?php echo"WELCOME ".$_SESSION['name'];?></h1>
    <form action='dashboard.php' method="POST">
        
            <tr>
                <td><button><a href="view_ticket_dashboard.php"><i class='fa fa-ticket'></i>VIEW TICKET</a></button></td>
                <td><button><a href="search_flight.php"><i class='fa fa-check'></i>BOOK FLIGHTS</a></button></td>
                <td><button><a href="change_details.php"><i class='fa fa-edit'></i>CHANGE DETAILS</a></button></td>
                <td><button><a href="logout.php">LOG OUT<i class='fa fa-sign-out'></i></a></button></td>
            </tr> 
        
    </form>
    <?php if(isset($_SESSION['error_in_view']) && $_SESSION['error_in_view']==true) echo'<p text-align="center">YOU HAVENT BOOKED ANY TICKET YET!</p>';?>
</body>
</html>