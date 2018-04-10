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
      
      
      
      $myold = mysqli_real_escape_string($connection,trim($_POST['Old'])); 
      
      $mynew = mysqli_real_escape_string($connection,trim($_POST['New']));
      
      if(!has_presence($myold) || !has_presence($mynew))
      {
         $errors["field"] = "All fields are mandatory.";
      }
      

      // $query = "SELECT * FROM Login WHERE UID = '$user_check' and pass = '$myold'"; 
      $query = "SELECT pass FROM Login WHERE UID = '$user_check'"; 
      
      
      $result = mysqli_query($connection,$query);
      
      

      if(!$result)
      {
         die("Database query failed");
      }
      
      
      
      $count = mysqli_num_rows($result); 
      // echo "$count";

      if($count > 0)
      {
        while ($row = mysqli_fetch_assoc($result)) {
          # code...
          // echo "<br/>{$row['pass']}";
        }
      }
      
     
      
      //mysqli_free_result($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if(empty($errors)) 
      {
         // echo "yes i work";
         if($count == 1)
         {
               // echo "yes i work";
            $query2 = "UPDATE Login set pass = '$mynew' where UID = '$user_check'";
            $result2 = mysqli_query($connection,$query2);

            $message = "Password updated successfully."; 

            if(!$result2)
            {
               die("Database query failed");
            }
              
         }
         else if($count == 0)
         {
            $message = "Incorrect details entered."; 
         }
         else
         {
            $message = "Invalid Action.";
         }
      }
      else 
      {
         $message = "Please fill in the required details.";
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
      <title> Update </title>

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

      margin-top: 5.8%;
      margin-left: 35%;
      position: absolute;
      width: 390px;
      height: 450px;
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

     
   
   

   #icon2{
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

  
  <?php $icon2 = "<b class='fa fa-lock' aria-hidden='true'></b>"?> 
    

</head>
   
   <body>

          

         <fieldset>
            <div style = "margin-left: 143%; margin-top: 45%;">
              <img src = "border.png">
            </div>
            <div style = "margin-left: -138.5%; margin-top: -190%;">
              <img src = "border.png" id = "rot">
            </div>

              <div style = "margin-top: -63%; margin-left: -3%;; color:#bbbbbb; font-size: 30px;"><i><center>Change Password</center></i></div>

              <br />
              <div style = "color:bbbbbb; font-size:18px;" align = "left">
                 <center><?php echo "  $message " . form_errors($errors); ?></center><br />
              </div> 

              <form action = "Update.php" method = "post">
               <div style = "margin-left:2px; margin-bottom:5px;">
                <table align = "center">
                  

                  <tr> 
                    <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon2"><?php echo $icon2;?></div></td>
                    <td><input type = "password" name = "Old" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter your old password"/><br /><br /><br/><br/></td>
                  </tr>


                  <tr>    
                    <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon2"><?php echo $icon2;?></div></td>
                    <td><input type = "password" name = "New" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter your new password"/><br /><br /><br/><br/></td>
                  </tr>

                </table>
               </div>
               <div style = "margint-top: 15%;">   
                  <input type = "submit" name = "submit" value = "Update" class = "button" id = "more" align = "middle"/>
                  <input type="button" value="Sign Out" class = "button" id = "more" align = "center" onclick="window.location.href='Logout.php'" />
                  <input type="button" value="Back" class = "button" id = "more" align = "center" onclick="window.location.href='Welcome.php'" />
               </div>
               </form>

              

            </fieldset>
           
      </body>
</html>