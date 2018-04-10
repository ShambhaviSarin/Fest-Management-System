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
      
      $myname = mysqli_real_escape_string($connection,trim($_POST['Name']));
      $myregno = mysqli_real_escape_string($connection,trim($_POST['Reg_no'])); 
      $myemail = mysqli_real_escape_string($connection,trim($_POST['Email']));
      $myphone = mysqli_real_escape_string($connection,trim($_POST['Phone']));
      
      if(!has_presence($myname) || !has_presence($myregno) || !has_presence($myemail) || !has_presence($myphone))
      {
         $errors["field"] = "All fields are mandatory.";
      }
      

      $query = "SELECT Reg_no FROM Registrations WHERE Reg_no = '$myregno'"; 
      $newquery = "SELECT Reg_no FROM Registrations WHERE Name = '$myname' OR Email_id = '$myemail' OR Phone_no = '$myphone'";
      $result = mysqli_query($connection,$query);
      $newresult = mysqli_query($connection,$newquery);

      if(!$result)
      {
         die("Database query failed");
      }
      if(!$newresult)
      {
         die("Database query failed");
      }
      
      $count = mysqli_num_rows($result);
      $count2 = mysqli_num_rows($newresult);
      
      //mysqli_free_result($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if(empty($errors)) 
      {
         if($count == 0 && $count2 == 0)
         {
               if(!strstr($myemail, '@'))
               {
                  $errors["email"] = "Incorrect email id";
               }
               if(!($myphone < 10000000000 || $myphone > 999999999))
               {
                  $errors["Phone"] = "Incorrect Phone Number";
               }
               if(!($myregno < 1000000000))
               {
                  $errors["Reg_No"] = "Incorrect Registration Number";
               }  
               $query2 = "INSERT INTO Registrations (Name, Reg_no, Email_id, Phone_no) VALUES ('{$myname}', {$myregno}, '{$myemail}', {$myphone})";
               //echo $query2;
               $result2 = mysqli_query($connection,$query2);
               if(!$result2)
               {
                  die("Database query 2 failed" . mysqli_error($connection));
               }
               else
               {
                  $query3 = "SELECT * FROM Registrations WHERE Reg_no = '$myregno' ";
                  $result3 = mysqli_query($connection,$query3);
                  if(!$result3)
                  {
                     die("Database query 2 failed" . mysqli_error($connection));
                  }
                  else
                  {
                     $message = "Your generated delegate number is: ";
                     if(mysqli_num_rows($result3)>0)
                     {
                        while ($row = mysqli_fetch_assoc($result3)) 
                        {
                           $message .= "{$row['Delegate_no']}";
                        }
                     }
                  }
               }

         }
         else if($count > 0)
         {
            $_POST["Registration Number"] =  $myregno;
            $message = "You have already registered.<br/>"; 
            $query3 = "SELECT * FROM Registrations WHERE Reg_no = '$myregno' ";
            $result3 = mysqli_query($connection,$query3);
            if(!$result3)
            {
               die("Database query 2 failed" . mysqli_error($connection));
            }
            else
            {
               $message .=  "Your generated delegate number is: ";
               if(mysqli_num_rows($result3)>0)
               {
                  while ($row = mysqli_fetch_assoc($result3)) 
                  {
                     $message .= "{$row['Delegate_no']}";
                  }
               }
            }
         }
         else
         {
            $message = "Duplicate details not allowed";
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
      <title>Register</title>

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
      /*border-color: transparent; */
      position: absolute;
      color: #bbbbbb;
      box-shadow: 3px 3px rgba(0,0,0,0.2);
      border: 2px solid rgba(255, 255, 255, 0.5);
      border-right-color: transparent;
      border-left-color:transparent;  

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
    width: 110px;
    margin-left: 3%;
    height: 45px;

    }

    .button:hover {
      box-shadow: 0 12px 16px 0 rgba(255,255,255,0.24), 0 17px 50px 0 rgba(255,255,255,0.19);
      background-color: rgba(255, 255, 255, 0.7);
      color: #000000;
   }

    fieldset{

      margin-top: 2.5%;
      margin-left: 36%;
      position: absolute;
      width: 390px;
      height: 570px;
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
      margin-left: 132%;
   }

    input:hover::placeholder { 
      color: #000000;
      text-decoration: bold;
      font-family: Comic Sans MS;
      font-size: 11px;
      margin-left: 132%;
   }
    

   input:focus { 
       background-color: transparent;
       border: 2px solid rgb(211, 211, 211);
       border-left-color: transparent;
       outline: none;
       /*color: #000000;*/
   }

   input:hover { 
       background-color: rgba(255, 255, 255, 0.5);
       /*box-shadow: 0 12px 16px 0 rgba(255,255,255,0.24), 0 17px 50px 0 rgba(255,255,255,0.19);*/
       outline: none;
       /*color: #000000;*/
   }  

    #more
    {
        cursor: pointer;
    }

    #icon1{
    width: 36px;
    margin-left: -26.7%;
    margin-top: -6.25%;
    position: absolute;
    height: 46px;
   }

   #icon2{
    width: 35px;
    margin-left: -26.7%;
    margin-top: -6.25%;
    position: absolute;
    height: 46px;
   }

   #icon3{
    width: 35.8px;
    margin-left: -26.7%;
    margin-top: -6.25%;
    position: absolute;
    height: 46px;
   }

   #icon4{
    width: 35.8px;
    margin-left: -26.7%;
    margin-top: -6.25%;
    position: absolute;
    height: 46px;
   }

    input{
      width:50px;
      margin-left: 1%;
      height: 20px;
      /*background-color: transparent;*/
      /*background: transparent;*/
    }
    b{
      margin-left: 35%;
      margin-top: 45%;
      display: inline;
      position:absolute;
      background-color: transparent;
      /*height: 60px;*/
    }
    td{
      height: 50px;
      width: 100px;
      /*margin-left: 85%;*/
    }

    #rot{
      /*rotation: 270deg;*/
      /*rotation-point:50% 50%;*/
      transform: rotate(180deg);
    }

  </style>  
  <?php $icon1 = "<b class='fa fa-user-o' aria-hidden='true'></b>"?>  
  <?php $icon2 = "<b class='fa fa-registered' aria-hidden='true'></b>"?>  
  <?php $icon3 = "<b class='fa fa-envelope' aria-hidden='true'></b>"?>  
  <?php $icon4 = "<b class='fa fa-phone' aria-hidden='true'></b>"?>    
</head>

        <body>

         <fieldset>

          <div style = "margin-left: 140%; margin-top: 58%;">
            <img src = "border.png">
          </div>
          <div style = "margin-left: -141%; margin-top: -191%;">
            <img src = "border.png" id = "rot">
          </div>

              <div style = "margin-top: -82%; margin-left: -3%;; color:#bbbbbb; font-size: 30px;"><i><center>Register</center></i></div>

              <br />
              <div style = "color:bbbbbb; font-size:18px;" align = "left">
                 <center><?php echo "  $message " . form_errors($errors); ?></center><br />
              </div> 

              <form action = "Register.php" method = "post">
               <div style = "margin-left:2px; margin-bottom:5px;">
                <table align = "center">
                  
                  <tr>    
                    <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon1"><?php echo $icon1;?></div></td>
                    <td><input type = "text" name = "Name" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter your name"/><br /><br /><br/><br/></td>
                  </tr>

                  <tr>
                      
                    <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon2"><?php echo $icon2;?></div></td>
                    <td><input type = "number" name = "Reg_no" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter your registration number"/><br/><br /><br/><br/></td>
                  </tr>

                  <tr>
                      
                    <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon3"><?php echo $icon3;?></div></td>
                    <td><input type = "text" name = "Email" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter your email-id"/><br /><br /><br/><br/></td>
                  </tr>

                  <tr>    
                    <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon4"><?php echo $icon4;?></div></td>
                    <td><input type = "number" name = "Phone" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter your phone number"/><br /><br /><br/><br/></td>
                  </tr>

                </table>
               </div>
               <div style = "margint-top: 4%;">   
                  <input type = "submit" name = "submit" value = "Submit" class = "button" id = "more" align = "middle"/>
                  <input type="button" value="Sign Out" class = "button" id = "more" align = "center" onclick="window.location.href='Logout.php'" />
                  <input type="button" value="Back" class = "button" id = "more" align = "center" onclick="window.location.href='Welcome.php'" />
               </div>
              </form>

              

            </fieldset>
            
      </body>
</html>