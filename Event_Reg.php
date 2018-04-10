<?php
   include('Connection.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $query = mysqli_query($connection,"SELECT UID FROM Login WHERE UID = '$user_check' ");
   
   $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
   if(!$result)
   {
      die("Database query failed");
   }
   
   if(!isset($_SESSION['login_user'])){
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
      
      
      $myevent = mysqli_real_escape_string($connection,trim($_POST['Event_id']));
      $mydelegate = mysqli_real_escape_string($connection,trim($_POST['Delegate_no'])); 
      $myname = mysqli_real_escape_string($connection,trim($_POST['Name']));
      $myphone = mysqli_real_escape_string($connection,trim($_POST['Phone']));
      
      if(!has_presence($myevent) || !has_presence($mydelegate) || !has_presence($myname) || !has_presence($myphone))
      {
         $errors["field"] = "All fields are mandatory.";
      }
      

      $query = "SELECT * FROM Registrations WHERE Delegate_no = '$mydelegate' and Name = '$myname' and Phone_no = '$myphone'"; 
      $query2 = "SELECT * FROM Events WHERE  Event_id = '$myevent' ";
      $query3 = "SELECT * FROM Event_reg WHERE Event_id = '$myevent' and Delegate_no = '$mydelegate'";
      $result = mysqli_query($connection,$query);
      $newresult = mysqli_query($connection,$query2);
      $chkresult = mysqli_query($connection,$query3);

      if(!$result)
      {
         die("Database query failed");
      }
      if(!$newresult)
      {
         die("Database query failed");
      }
      if(!$chkresult)
      {
         die("Database query failed");
      }
      
      $count = mysqli_num_rows($result); 
      // echo "$count";
      $count2 = mysqli_num_rows($newresult); 
      // echo "$count2";
      $count3 = mysqli_num_rows($chkresult); 
      // echo "$count3";
      
      //mysqli_free_result($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if(empty($errors)) 
      {
         // echo "yes i work";
         if($count == 1 && $count2 == 1 && $count3 == 0)
         {
               // echo "yes i work";
               
               $query2 = "INSERT INTO Event_reg (Event_id, Delegate_no) VALUES ('{$myevent}', '{$mydelegate}')";
               //echo $query2;
               $result2 = mysqli_query($connection,$query2);
               if(!$result2)
               {
                  die("Database query 2 failed" . mysqli_error($connection));
               }
               else
               {
                  
                     $message = "You have successfully registered.";
                     
               }

         }
         else if($count3 > 0)
         {
            $message = "You have already registered for this event.<br/>"; 
         }
         else
         {
            $message = "You have entered incorrect details.";
         }
      }
      else 
      {
         $myregno = "";
         $message = "Please fill in the following details.";
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
      <title> Event Registration</title>

       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      
      <style type="text/css">

    body {
      
      font-family: Times New Roman;
      font-size: 2em;
      font-weight: 700;
      overflow: hidden;

        
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
    
    .box{

      width: 397px;
      height: 50px;
      margin-top: 2%;
      margin-left: -41.5%;
      background-color: transparent;
      opacity:0.9;
      border: 2px solid rgba(255, 255, 255, 0.5);
      border-right-color: transparent;
      border-left-color:transparent;  
      position: absolute;
      color: #bbbbbb;
      box-shadow: 3px 3px rgba(0,0,0,0.2);

    }

    .button{

    background-color: transparent; 
    color: #d6d6d6;
    border: 2px solid rgba(255, 255, 255, 0.7);
    padding: 10px 25px;
    margin-top: 10%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 0.2em; 
    font-family: Times new Roman;
    -webkit-transition-duration: 0s;
    width: 100px;
    margin-left: 2.5%;

    }

    .button:hover {
      box-shadow: 0 12px 16px 0 rgba(255,255,255,0.24), 0 17px 50px 0 rgba(255,255,255,0.19);
      background-color: rgba(255, 255, 255, 0.7);
      color: #000000;
   }

    fieldset{

      margin-top: 0.5%;
      margin-left: 35%;
      position: absolute;
      width: 390px;
      height: 620px;
      /*border-radius: 0.25em ;*/
      border-color: transparent; 
      background-color: rgba(0, 0, 0, 0.5);
      box-shadow: 3px 3px rgba(0,0,0,0.2);
      color: #d3d3d3;
      position: absolute;
    }

    ::placeholder { 
      color: #d3d3d3;
      text-decoration: bold;
      font-family: Comic Sans MS;
      font-size: 11px;
   }
    input:hover::placeholder { 
      color: #000000;
      text-decoration: bold;
      font-family: Comic Sans MS;
      font-size: 11px;
      /*margin-left: 132%;*/
   }

   input:focus { 
       background-color: transparent;
       border: 2px solid rgb(211, 211, 211);
       border-left-color: transparent;
       outline: none;
   }

   input:hover { 
       background-color: rgba(255, 255, 255, 0.5);
       /*box-shadow: 0 12px 16px 0 rgba(255,255,255,0.24), 0 17px 50px 0 rgba(255,255,255,0.19);*/
       outline: none;
   }  

    #more
    {
        cursor: pointer;
    }

     #icon1{
    width: 36px;
    margin-left: -49.7%;
    margin-top: -6.2%;
    position: absolute;
    height: 46px;
   }

   #icon2{
    width: 35px;
    margin-left: -49.5%;
    margin-top: -6.2%;
    height: 46px;
    position: absolute;
   }

   #icon3{
    width: 35.8px;
    margin-left: -49.7%;
    margin-top: -6.2%;
    position: absolute;
    height: 46px;
   }

   #icon4{
    width: 35.8px;
    margin-left: -49.7%;
    margin-top: -6.2%;
    position: absolute;
    height: 46px;
   }

    input{
      width:50px;
    }
    b{
      margin-left: 26%;
      margin-top: 45%;
      display: inline;
      position:absolute;
    }
    #rot{
      /*rotation: 270deg;*/
      /*rotation-point:50% 50%;*/
      transform: rotate(180deg);
    }

  </style> 

  <?php $icon3 = "<b class='fa fa-user-o' aria-hidden='true'></b>"?>  
  <?php $icon2 = "<b class='fa fa-id-card-o' aria-hidden='true'></b>"?>  
  <?php $icon1 = "<b class='fa fa-hashtag' aria-hidden='true'></b>"?>  
  <?php $icon4 = "<b class='fa fa-phone' aria-hidden='true'></b>"?>         

</head>
   
   <body>

          

         <fieldset>
            <div style = "margin-left: 143%; margin-top: 65%;">
              <img src = "border.png">
            </div>
            <div style = "margin-left: -138.5%; margin-top: -190%;">
              <img src = "border.png" id = "rot">
            </div>

              <div style = "margin-top: -82%; margin-left: -3%;; color:#bbbbbb; font-size: 30px;"><i><center>Event-Registration</center></i></div>

              <br />
              <div style = "color:bbbbbb; font-size:18px;" align = "left">
                 <center><?php echo "  $message " . form_errors($errors); ?></center><br />
              </div> 

              <form action = "Event_Reg.php" method = "post">
               <div style = "margin-left:2px; margin-bottom:5px;">
                <table align = "center">
                  
                  <tr>
                    <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon1"><?php echo $icon1;?></div></td>
                    <td><input type = "text" name = "Event_id" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter Event-ID"/><br/><br /><br/><br/></td>
                  </tr>

                  <tr> 
                    <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon2"><?php echo $icon2;?></div></td>
                    <td><input type = "number" name = "Delegate_no" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter your delegate number"/><br /><br /><br/><br/></td>
                  </tr>

                  <tr>    
                    <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon3"><?php echo $icon3;?></div></td>
                    <td><input type = "text" name = "Name" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter your name"/><br /><br /><br/><br/></td>
                  </tr>

                  <tr>    
                    <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon4"><?php echo $icon4;?></div></td>
                    <td><input type = "number" name = "Phone" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter your phone number"/><br /><br /><br/><br/></td>
                  </tr>

                </table>
               </div>
               <div style = "margint-top: 15%;">   
                  <input type = "submit" name = "submit" value = "Submit" class = "button" id = "more" align = "middle"/>
                  <input type="button" value="Sign Out" class = "button" id = "more" align = "center" onclick="window.location.href='Logout.php'" />
                  <input type="button" value="Back" class = "button" id = "more" align = "center" onclick="window.location.href='Welcome.php'" />
               </div>
               </form>

              

            </fieldset>
           
      </body>
</html>