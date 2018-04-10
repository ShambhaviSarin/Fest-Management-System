<?php
   session_start();
   include('Connection.php');
   
   
   $user_check = $_SESSION['login_user'];
   
   $query = mysqli_query($connection,"SELECT UID FROM Login WHERE UID = '$user_check' ");
   
   $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
   if(!$result)
   {
      die("Database query failed");
   }
   
   if(!isset($_SESSION['login_user']))
   {
      header("Location:Login.php");
   }
?>
<?php
   session_start();
   function has_presence($value)
   {
      return(isset($value) && $value !== "");
   
   }
   $errors = array();
   $message = "";
   if(isset($_POST['submit']))
   { 
      
      $mysearch = mysqli_real_escape_string($connection,trim($_POST['Search']));

      if(!has_presence($mysearch))
      {
         $errors["field"] = "Please enter details to Search.";
      }

      $query1 = "SELECT * FROM Registrations WHERE Delegate_no = '$mysearch'";
      $query2 = "SELECT * FROM Registrations WHERE Reg_no = '$mysearch'";
      $query3 = "SELECT * FROM Events WHERE Event_id = '$mysearch'";
      $query4 = "SELECT * FROM Categories WHERE Category_id = '$mysearch'";
      $query5 = "SELECT * FROM Judges WHERE Judge_id = '$mysearch'";

      $result1 = mysqli_query($connection,$query1);
      $result2 = mysqli_query($connection,$query2);
      $result3 = mysqli_query($connection,$query3);
      $result4 = mysqli_query($connection,$query4);
      $result5 = mysqli_query($connection,$query5);

      if(!$result1 || !$result2 || !$result3 || !$result4 || !$result5)
      {
         die("Database query failed");
      }

      $count1 = mysqli_num_rows($result1);
      $count2 = mysqli_num_rows($result2);
      $count3 = mysqli_num_rows($result3);
      $count4 = mysqli_num_rows($result4);
      $count5 = mysqli_num_rows($result5);

      // $msg = "$count1 <br/> $count2 <br/> $count3 <br/> $count4 <br/> $count5 <br/>";

      if(empty($errors)) 
      {
         if($count1 == 0 && $count2 == 0 && $count3 == 0 && $count4 == 0 && $count5 == 0)
         {  
            $message = "No details found.";
         }
         else if($count1 == 1)
         {

            $q1 = "SELECT * FROM Registrations natural join Event_reg WHERE Delegate_no = '$mysearch'";
            $r1 = mysqli_query($connection,$q1);

            if(!$r1)
            {
               die("Database query failed");
            }
            $c1 = mysqli_num_rows($r1);
            // echo " $c1  This is c1";
            // $message = "$c";*/
            $message .= "<center><table><tr> <th> Delegate Number</th> <th>Name</th>  <th>Registration Number</th> <th>Email ID</th> <th>Phone Number</th> </tr>";

            while ($row = mysqli_fetch_assoc($result1)) 
            {
               $message .= "<br/><tr><td>{$row['Delegate_no']}</td>";
               $message .= "<td>{$row['Name']}&nbsp;&nbsp; </td>";
               $message .= "<td>&nbsp;&nbsp;{$row['Reg_no']} </td>";
               $message .= "<td>{$row['Email_id']} </td>";
               $message .= "<td>{$row['Phone_no']}</td></tr>";
               
            }
            $message .= "</table></center>";
            $message .= "<br/><br/><br/><br/><br/><br/><br/>";

            if($c1 > 0)
            {
              $message .= "<center><table><tr> <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Event(s) registered for: <th><br/></tr>";
              while ($row = mysqli_fetch_assoc($r1)) 
              {
                $message .= "<tr><td>{$row['Event_id']}</td></tr>";
              }
              $message .= "</table></center>";

            }

            
         }
         else if($count2 == 1)
         {

            $q2 = "SELECT * FROM Registrations natural join Event_reg WHERE Reg_no = '$mysearch'";
            $r2 = mysqli_query($connection,$q2);
            if(!$r2)
            {
               die("Database query failed");
            }
            $c2 = mysqli_num_rows($r2);
            // echo " $c2  This is c2";
            // $msg = "$c2";
            $message = "<center><table><tr> <th>Delegate Number</th>  <th>Name</th>  <th>Registration Number</th>  <th>Email ID</th>  <th>Phone Number</th> </tr>";

            while ($row = mysqli_fetch_assoc($result2)) 
            {
               $message .= "<br/><tr><td>{$row['Delegate_no']}</td>";
               $message .= "<td>{$row['Name']}&nbsp;&nbsp; </td>";
               $message .= "<td>&nbsp;&nbsp;{$row['Reg_no']} </td>";
               $message .= "<td>{$row['Email_id']} </td>";
               $message .= "<td>{$row['Phone_no']}</td></tr>";
               
            }
            $message .= "</table></center>";
            $message .= "<br/><br/><br/><br/><br/><br/><br/><br/>";

            if($c2 > 0)
            {
              $message .= "<center><table><tr> <th>Event(s) registered for: <th><br/></tr>";
              while ($row = mysqli_fetch_assoc($r2)) 
              {
                $message .= "<tr><td>{$row['Event_id']}</td></tr>";
              }
              $message .= "</table></center>";

            }

            
         }
         elseif ($count3 == 1) 
         {
           # code...
             $message = "<center><table><tr> <th>Category ID&nbsp;&nbsp;&nbsp;&nbsp;</th> <th>Event ID</th> <th>Event Name</th>  <th>Day</th> <th>&nbsp;&nbsp;&nbsp;&nbsp;Duration(hrs)</th> <th>&nbsp;&nbsp;&nbsp;&nbsp;Room Number</th> </tr>";

             while ($row = mysqli_fetch_assoc($result3)) 
             {
                $message .= "<br/><tr><td>{$row['Category_id']}</td>";
                $message .= "<td>{$row['Event_id']}&nbsp;&nbsp; </td>";
                $message .= "<td>&nbsp;&nbsp;{$row['Event_name']} </td>";
                $message .= "<td>{$row['Day']} </td>";
                $message .= "<td>{$row['Duration(hrs)']}</td>";
                $message .= "<td>{$row['Room_no']}</td></tr>";
                
             }

             $message .= "</table></center>";
          
         }
         elseif ($count4 == 1) 
         {
           # code...
          $message = "<center><table><tr> <th>Category ID&nbsp;&nbsp;</th> <th>Category Name&nbsp;&nbsp;</th> <th>Number of Events</th> <th>Cat-Head</th> <th>Contact Number</th> </tr>";

          while ($row = mysqli_fetch_assoc($result4)) 
          {
             $message .= "<br/><tr><td>{$row['Category_id']}</td>";
             $message .= "<td>{$row['Category_name']}</td>";
             $message .= "<td>{$row['No_of_events']}&nbsp;&nbsp; </td>";
             $message .= "<td>{$row['Cat_Name']}&nbsp;&nbsp; </td>";
             $message .= "<td>&nbsp;&nbsp;{$row['Cat_phone']} </td></tr>";
          }

          $message .= "</table></center>";
         }
         elseif ($count5 == 1) 
         {
           # code...
          $q3 = "SELECT * FROM Judges natural join Judged_by WHERE Judge_id = '$mysearch'";
          $r3 = mysqli_query($connection,$q3);
          if(!$r3)
          {
             die("Database query failed");
          }
          $c3 = mysqli_num_rows($r3);
          // $msg = "$c1";
          if($c3 > 0)
          {
            $message = "<center><table><tr> <th>Event ID&nbsp;&nbsp;</th> <th>Judge ID&nbsp;&nbsp;</th> <th>Name</th> <th>Contact Number</th> </tr>";

            while ($row = mysqli_fetch_assoc($r3)) 
            {
              $message .= "<br/><tr><td>{$row['Event_id']}</td>";
              $message .= "<td>{$row['Judge_id']}</td>";
              $message .= "<td>{$row['Name']}&nbsp;&nbsp; </td>";
              $message .= "<td>&nbsp;&nbsp;{$row['Phone_no']} </td></tr>";
            }

            $message .= "</table></center>";
          }
          else
          {
            $message = "<center><table><tr> <th>Judge ID&nbsp;&nbsp;</th> <th>Name</th> <th>Contact Number</th> </tr>";

            while ($row = mysqli_fetch_assoc($result5)) 
            {
              
              $message .= "<br/><tr><td>{$row['Judge_id']}</td>";
              $message .= "<td>{$row['Name']}&nbsp;&nbsp; </td>";
              $message .= "<td>&nbsp;&nbsp;{$row['Phone_no']} </td></tr>";
            }

            $message .= "</table></center>";
          }
         }
         else
         {
            $message = "No records found.";
         }
      }
      else
      {
        $message = "Invalid action.";
      }
    }

?>
<?php 
      //echo $message;
      echo "<br />";
      function form_errors($errors=array())
      {
         $output = "";
         if(!empty($errors))
         {
            $output .= "<div class=\"error\">";
            foreach ($errors as $key => $error) 
            {
               $output .= "&nbsp; {$error}";
            }
            $output .= "</div>";
         }
            return $output;
      }
?>
<html>
   
   <head>
      <title>Search Result</title>
      
      <style type="text/css">

    body {
                  font-family: Times New Roman;
                  font-size: 2em;
                  font-weight: 700;
                 
                    /*background: linear-gradient(-45deg, #23A6D5, #E73C7E, #23A6D5, #23D5AB);*/
                    /*background: linear-gradient(-45deg, #666699, #8c334c, #d1471f , #ff6600, #d1b2d1);*/
                    background: linear-gradient(45deg, #cc3300, #6a6a56, #07a2ac, #3b4986, #660066, #3b4986);
                    background-size: 400% 400%;
                    animation: Gradient 10s ease infinite;
                  }
                    @keyframes Gradient {
                      0% {
                        background-position: 0% 50%
                      }
                      50% {
                        background-position: 100% 50%
                      }
                      100% {
                        background-position: 0% 80%
                      }  
                    }

    .button{

    background-color: transparent; 
    color: #d6d6d6;
    border: 2px solid rgba(255, 255, 255, 0.7);
    padding: 10px 25px;
    margin-top: 1%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 0.2em; 
    font-family: Times new Roman;
    -webkit-transition-duration: 0s;
    margin-left: 9%;
    width: 135px;
    /*position: absolute;*/

    }

    .button:hover {
      box-shadow: 0 12px 16px 0 rgba(255,255,255,0.24), 0 17px 50px 0 rgba(255,255,255,0.19);
      background-color: rgba(255, 255, 255, 0.7);
      color: #000000;
   }

    fieldset{

      margin-top: 10%;
      margin-left: 10%;
      position: absolute;
      width: 1050px;
      height: 400px;
      /*border-radius: 0.25em ;*/
      border-color: transparent; 
      background-color: rgba(0, 0, 0, 0.5);
      box-shadow: 3px 3px rgba(0,0,0,0.2);
      color: #d3d3d3;
      /*position: absolute;*/
    }

   table
    {
            color: #f0f0f0;
            margin-top: -5%;
            font-family: Georgia;
            font-size: 20px;
            text-align: center;
            position: absolute;
    }

    td 
    {
            padding:15px 50px 3px 50px;
            text-align: center;
            margin-top: 5%;
            font-family: Times New Roman;
    }
    tr 
    {
            margin-top: 12%;
    }
    th 
    {
            margin-top: -125%;
            font-family: Times New Roman;
            font-size: 25px;
    }

    #more
    {
        cursor: pointer;
    }
    #rot1{
      /*rotation: 270deg;*/
      /*rotation-point:50% 50%;*/
      transform: rotate(270deg);
    }
    #rot{
      /*rotation: 270deg;*/
      /*rotation-point:50% 50%;*/
      transform: rotate(90deg);
    }
    img{
      position: absolute;
    }


  </style>      
   </head>
   <body>


         <fieldset>

          <div style = " margin-left: 85%; margin-top: -14%">
            <img src="b1.svg" id = "rot1" height = "590">
          </div>
          <div style = " margin-top: 3%; margin-left: -57%;">
            <img src="b1.svg" id = "rot" height = "590">
          </div>

          <!-- <div style = "margin-top: 6%; margin-left: -3%;; color:#bbbbbb; font-size: 30px;"><i><center>Search</center></i></div> -->

              <br />
              <div style = "color:bbbbbb; font-size:18px; margin-top: 12%;" align = "left" id = "pos">
                 <center><?php echo "  $message "?></center><br />
              </div> 

              <form action = "Search.php" method = "post">
                  
                  <div style = "margin-top: 7%; margin-left: 12%;" id = "pos">
                     <input type = "submit" value = "Search Again" class = "button" id = "more" align = "center" onclick="window.location.href='Search.php'" />
                     <input type="button" value="Sign Out" class = "button" id = "more" align = "center" onclick="window.location.href='Logout.php'" /> 
                     <input type="button" value="Back" class = "button" id = "more" align = "center" onclick="window.location.href='Welcome.php'" /> 
                  </div>
               </form>
              

            </fieldset>
        </body>
</html>

   
   
                   
         
                    
         
               
               
               