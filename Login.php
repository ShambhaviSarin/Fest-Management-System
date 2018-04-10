<?php
   session_start();
   include('Connection.php');
   //session_start();
   function has_presence($value)
   {
      return(isset($value) && $value !== "");
   
   }
   $errors = array();
   $message = "";
   
   if(isset($_POST['submit']))
   {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($connection,trim($_POST['username']));
      $mypassword = mysqli_real_escape_string($connection,trim($_POST['password'])); 
      
      //$username = trim($_POST["username"]);
      //$password = trim($_POST["password"]);
      if(!has_presence($myusername))
      {
         $errors["username"] = "Username/Password can't be blank.";
      }

      $query = "SELECT UID FROM Login WHERE UID = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($connection,$query);
      if(!$result)
      {
         die("Database query failed");
      }
      
      $count = mysqli_num_rows($result);
      //mysqli_free_result($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if(empty($errors)) 
      {
         if($count == 1)
         {
            $_SESSION['login_user'] = $myusername;
            header("Location: Welcome.php");            
         }
         else
         {
            $_POST["username"] =  $myusername;
            $message = "Username/Password do not match.";
         }
      }
      else 
      {
         $myusername = "";
         $message = "Please log in.";
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
      <title>Login</title>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <style type="text/css">

    body {
      background-attachment: fixed;
      background-clip: border-box;
      background-image: url("design.png");
      background-origin: padding-box;
      background-repeat: no-repeat;
      background-size: 100% 100%;
      font-family: Times New Roman;
      font-size: 2em;
      font-weight: 700;
      overflow: hidden;
      min-height: 100%;
    }

    
    
    .box{

      width: 385px;
      height: 50px;
      margin-top: 2%;
      margin-left: -42%;
      background-color: transparent;
      opacity:0.9;
      /*border-color: transparent; */
      position: absolute;
      color: #000000;
      box-shadow: 0px 1px rgba(255,255,255,0.2);
      border: 2px solid rgba(0, 0, 0, 0.4);
      border-right-color: transparent;
      border-left-color:transparent; 

    }

    .button{

    background-color: transparent; 
    color: #000000;
    border: 2px solid rgba(0, 0, 0, 0.7);
    padding: 10px 25px;
    margin-top: 10%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 0.2em; 
    font-family: Times new Roman;
    -webkit-transition-duration: 0s;
    width: 120px;

    }

    .button:hover {
      box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
      background-color: rgba(0, 0, 0, 0.7);
      color: #ffffff;
   }

   

    fieldset{

      margin-top: -57%;
      margin-left: 36%;
      position: absolute;
      width: 370px;
      height: 560px;
      border-radius: 0.25em ;
      border-color: transparent; 
      background-color: rgba(255, 255, 255, 0.5);
      /*background-color: rgba(192, 192, 192, 0.3);*/
      /*background-color: rgba(100, 100, 100, 0.5);*/
      /*background: linear-gradient(to top right, rgba(116, 250, 191, 0.7), rgba(177, 246, 255, 0.5));*/
      /*background-color: rgba(75, 209, 73, 0.5);*/
      box-shadow: 5px 5px rgba(255,255,255,0.2);
      color: #d3d3d3;
      position: absolute;
    }

    ::placeholder { 
          color: #000000;
          text-decoration: bold;
          font-family: Comic Sans MS;
          font-size: 11px;
          margin-left: 132%;
       }

        input:hover::placeholder { 
          color: #d3d3d3;
          text-decoration: bold;
          font-family: Comic Sans MS;
          font-size: 11px;
          margin-left: 132%;
       }
        

       input:focus { 
           background-color: transparent;
           border: 2px solid rgba(0, 0, 0, 0.5);
           border-left-color: transparent;
           outline: none;
           /*color: #000000;*/
       }

       input:hover { 
           background-color: rgba(0, 0, 0, 0.8);
           border: 2px solid rgba(0, 0, 0, 0.7);
           /*box-shadow: 0 12px 16px 0 rgba(255,255,255,0.24), 0 17px 50px 0 rgba(255,255,255,0.19);*/
           outline: none;
           /*color: #000000;*/
       }  

  
   #icon{
    width: 36px;
    margin-left: -49.7%;
    margin-top: -6.5%;
    position: absolute;
    height: 46px;
   }

   #icon2{
    width: 35px;
    margin-left: -49.5%;
    margin-top: -4.5%;
    position: absolute;
    height: 46px;
   }
   
    #more
    {
        cursor: pointer;
    }
    input{
      width:50px;
      /*color: #000000;*/
    }
    b{
      margin-left: 26%;
      margin-top: 45%;
      display: inline;
      position:absolute;
    }

   
  </style>    
  <script type="text/javascript" src="design.js"></script>
  <?php $icon = "<b class='fa fa-user-o' aria-hidden='true'></b>"?> 
  <?php $icon2 = "<b class='fa fa-lock' aria-hidden='true'></b>"?> 
  
</head>

        <body>

          <div style = " margin-top:-10%; height:1000px;" id='particle-js'>nbsp;</div>
          <center>
       
         <fieldset>

           <div style = "margin-top: 8%; margin-left: -3%;; color:#000000;">Cultural Fest '18</div>  
              <div style = "margin-top: 15%; margin-left: -3%;; color:#000000; font-size: 22px;"><i>Login to your account</i></div>

              <br />
              <div style = "color:000000; font-size:18px;" align = "left">
                 <center><?php echo "  $message " . form_errors($errors); ?></center><br />
              </div> 

              <form action = "Login.php" method = "post">
               
              <div style = "margin-top: 2%;">
                <table align = "center">
                  
                    <tr>
                      
                      <td style="color:#000000; margin-left:-20%;"><div class = "box" id = "icon" style = "color: #000000;"><?php echo $icon;?></div></td>
                      <td><input type = "text" name = "username" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter username"/><br /><br/></br></br></td>
                     
                    </tr>
                  
                  <tr>
                  <div style = "margin-top: -3%;">
                     <td style="color:#000000; margin-left:-20%;"><div class = "box" id = "icon2" style = "color: #000000;"><?php echo $icon2;?></div></td>
                     <td><input type = "password" name = "password" class = "box" placeholder = "&nbsp;&nbsp;&nbsp;Enter password" /><br/></br></br></td>
                  </div> 
                  </tr>
                </table>
                  <div style = "margin-top: 8%; margin-left: -5%;">
                     <center><input type = "submit" name = "submit" value = " Submit " class = "button" id = "more" align = "middle"/></center>
                  </div>
               </div>
              </form>

              

            </fieldset>
          </center>
          <script type="text/javascript" src="particles.js"></script>
            
        </body>
</html>
