 <?php
  $num_o=false;
  $num_d=false;
  $same_city=false;
  $atleast_one_null=false;
  $atleast_one_error=false;
  $invalid_city=false;

     session_start();
     include ("config.php");

     if(isset($_POST['type']))
     {
       $_SESSION['flight_type']=$_POST['type'];
     }
     echo "<form method='POST' action='search_flight.php'>
     <table  align='center' rules='none'>
     <tr><th>Flight type:<button type='submit' name='type' value=1>Single Trip</button><button type='submit' name='type' value=2>Round Trip</button></th></tr>
   </table>"; 
?>

<?php

if(isset($_SESSION['flight_type']))
{
         echo " <div id='display_part'>   
                  <table border='2' align='center' class='logintable'>

                  
                  <tr><td colspan='2' align='center'>
                  <datalist id='mylist'>
                  <option value='Mumbai'>
                  <option value='Dehli'>
                  <option value='Tokyo'>
                  <option value='Hongkong'>
                  <option value='Dubai'>
                  <option value='Paris'>
                  <option value='Sydney'>
                  <option value='Los Angeles'>
                  <option value='New York'>
                  <option value='Rome'>
                  </datalist>
                  <input type='text' name='origin' list='mylist' placeholder='From' id='origin'>
                  </td></tr>


                  <tr><td colspan='2'  align='center'>
                  <datalist id='mylist'>
                  <option value='Mumbai'>
                  <option value='Dehli'>
                  <option value='Tokyo'>
                  <option value='Hongkong'>
                  <option value='Dubai'>
                  <option value='Paris'>
                  <option value='Sydney'>
                  <option value='Los Angeles'>
                  <option value='New York'>
                  <option value='Rome'>
                  </datalist>
                  <input type='text' name='destination' list='mylist' placeholder='To' id='destination'>
                  </td></tr>

                  <tr>
                  <th align='center' colspan='2'>Departure Date:</th></tr>
                  <td colspan='2' align='center'><input type='date' name='ddate' id='ddate' ></td>
                  </tr>";

                  if($_SESSION['flight_type']==2)
                  {
                    echo "<tr>
                          <th colspan='2' align='center'>Arrival Date:</th></tr>
                          <td colspan='2' align='center'><input type='date' name='adate' id='adate' min='2021-07-05' ></td>
                          </tr>";
                  }

                  echo "<tr>
                        <th>Class:</th>
                        <td>Economy<input type='radio' name='c_box' value='E' id='c_box'>Business:<input type='radio' name='c_box' value='B' id='c_box'></td>
                        </tr>

                        <tr>
                        <td colspan='2' align='center'><input type='submit' name='Search_flight' value='Search flight'>
                        </td>
                        </tr>
                        <tr>
                        <td colspan='2'  align='center' ><a  href='dashboard.php'>DASHBOARD</a></td>
                        </tr>
                        </table>
                        </div>
                        </form>
                        ";
}

 if(isset($_POST['Search_flight']))
 {

  /*field validation */
  $pattern="/[^a-z A-Z]/";
  
  if(preg_match($pattern,$_POST['origin']))
  {
    $num_o=true;
  }

  if(preg_match($pattern,$_POST['destination']))
  {
    $num_d=true;
  }

  if($_POST['origin']==$_POST['destination'])
  {
    $same_city=true;
    echo "<p text-align='center'>You seriously want to travel to the same city?!!!</p><br>";
  }
  if($num_o || $num_d)
  {
    echo "<p text-align='center'>There should be no numbers and special characters inside fields of origin and destination cities</p><br>";
    
  }

  if($_SESSION['flight_type']==1)
  if(empty($_POST['origin'])|| empty($_POST['destination']) || empty($_POST['ddate']) || empty($_POST['c_box']))
  {
    $atleast_one_null=true;
    echo "<p text-align='center'>You cannot leave any fields empty</p><br>";
  }

  if($_SESSION['flight_type']==2)
  if(empty($_POST['origin']) || empty($_POST['destination']) || empty($_POST['ddate']) || empty($_POST['adate']) || empty($_POST['c_box']))
  {
    $atleast_one_null=true;
    echo "<p text-align='center'>You caanot leave any fields empty</p><br>";
  }

  //echo $_POST['origin'];
  //echo $_POST['destination'];

   $origin=mysqli_real_escape_string($link,$_POST['origin']);
   $desti=mysqli_real_escape_string($link,$_POST['destination']);

     $o_que="SELECT * FROM `airport` WHERE `city`='$origin'";
     $o_res=mysqli_query($link,$o_que);
     $o_row=mysqli_fetch_assoc($o_res);
     $empty_o_row_city=empty($o_row['city']);

     $d_que="SELECT * FROM `airport` WHERE `city`='$desti'";
     $d_res=mysqli_query($link,$d_que);
     $d_row=mysqli_fetch_assoc($d_res);
     $empty_d_row_city=empty($d_row['city']);


   if($empty_o_row_city || $empty_d_row_city)
   {
     $invalid_city=true;
     echo "<p text-align='center'>Put in valid city names</p><br>";
   }  

   if($atleast_one_null || $num_d || $num_o || $same_city || $invalid_city)
   {
     $atleast_one_error=true;
   }

   if($atleast_one_error)
   {
     echo "<p text-align='center'>Fill your form correctly</p><br>";
   }

   else
   {
     $_SESSION['origin']=$_POST['origin'];
     $_SESSION['destination']=$_POST['destination'];
     $_SESSION['departure_date']=$_POST['ddate'];
     $_SESSION['class']=$_POST['c_box'];
     if($_SESSION['flight_type']==2)
     {
       $_SESSION['arrival_date']=$_POST['adate'];
       //echo $_SESSION['arrival_date'];
     }
     $_SESSION['submitted_search_flight']=true;
     header("Location:view_flight1.php");
   }
 }
  ?> 
  <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>search Flight</title>
  <link rel="stylesheet" href="flight_project.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

</body>
</html>