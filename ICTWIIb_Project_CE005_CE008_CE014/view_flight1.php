<?php
  session_start();
  include ("config.php");

?>
<html>
<head>
    <style>
      table{
        border-collapse:collapse;
      }
      #_table  th{
        border: 2px solid black;
      }
      #_table  td{
        border: 2px solid black;
      }
    </style>

   <link rel="stylesheet" href="flight_project.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<form action="view_ticket(Aadit).php" method='POST'>
<table border="2" style="width: 50%; background-color:  #a6bed9;" align="center" id="_table">
<tr>
 <th><strong>airway</strong></th>
    <th><strong>origin</strong></th>
    <th><strong>destination</strong></th>
    <th><strong>departure date</strong></th>
    <?php
      if($_SESSION['flight_type']==2)
      {
        echo "<th><strong>arrival date</strong></th>";
      }
    ?>
    <th><strong>departure time</strong></th>
    <th><strong>arrival time</strong></th>
    <th><strong>Duration</strong></th>
    <th><strong>class</strong></th>
    <th><strong>price</strong></th>
    <th><strong>Book flight</strong></th>
</tr>


<?php
  if($_SESSION['submitted_search_flight'])
  {
      $origin=mysqli_real_escape_string($link,$_SESSION['origin']);
      $destination=mysqli_real_escape_string($link,$_SESSION['destination']);
      $o_que="SELECT `id`, `country`, `city`, `airport` FROM `airport` WHERE `city`='$origin'";
      $o_res=mysqli_query($link,$o_que);
      $o_row=mysqli_fetch_assoc($o_res);

      $d_que="SELECT `id`, `country`, `city`, `airport` FROM `airport` WHERE `city`='$destination'";
      $d_res=mysqli_query($link,$d_que);
      $d_row=mysqli_fetch_assoc($d_res);


      for($i=1;$i<=7;$i++)
      {
        if($d_row['country']=='India' && $o_row['country']=='India')
        {
            $air_data_que="SELECT `id`, `airway_name`, `departure_time`, `arrival_time`, `duration`, `e_price`, `b_price` FROM `search_flight_domestic` WHERE `id`='$i'";
            $air_data_res=mysqli_query($link,$air_data_que);
            $air_data_row=mysqli_fetch_assoc($air_data_res);
        }  

        else
        {
          $air_data_que="SELECT `id`, `airway_name`, `departure_time`, `arrival_time`, `duration`, `e_price`, `b_price` FROM `search_flight_international` WHERE `id`='$i'";
          $air_data_res=mysqli_query($link,$air_data_que);
          $air_data_row=mysqli_fetch_assoc($air_data_res);
        }
          echo "<tr>
                <td align='center'>".$air_data_row['airway_name']."</td>
                <td align='center'>".$_SESSION['origin']."</td>
                <td align='center'>".$_SESSION['destination']."</td>
                <td align='center'>".$_SESSION['departure_date']."</td>";
                
                if($_SESSION['flight_type']==2)
                {
                  echo "<td align='center'>".$_SESSION['arrival_date']."</td>";
                }

                echo "<td align='center'>".$air_data_row['departure_time']."</td>
                      <td align='center'>".$air_data_row['arrival_time']."</td>
                      <td align='center'>".$air_data_row['duration']."";
                if($_SESSION['class']=='E')
                {
                  echo "<td align='center'>Economy</td>
                        <td align='center'>".$air_data_row['e_price']."Rs</td>";
                }

                else{
                  echo "<td align='center'>Business</td>
                        <td align='center'>".$air_data_row['b_price']."Rs</td>";
                }

              echo "<td align='center'><button type='submit' name='book' value='$i'>Book</button></td>
              </tr>";

      }
    

  }



?>