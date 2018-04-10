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
<html>
   
   <head>
      <title>Welcome</title>

      

  <style type="text/css">

    body {
      
      font-family: Times New Roman;
      font-size: 2em;
      font-weight: 700;
      overflow: hidden;

        width: 100wh;
        height: 90vh;
        color: #fff;
        /*background: linear-gradient(-45deg, #23A6D5, #E73C7E, #23A6D5, #23D5AB);*/
        /*background: linear-gradient(-45deg, #666699, #8c334c, #d1471f , #ff6600, #d1b2d1);*/
        background: linear-gradient(45deg, #cc3300, #6a6a56, #07a2ac, #3b4986, #660066, #3b4986);
        background-size: 400% 400%;
        animation: Gradient 10s ease infinite;
        
      }
        @keyframes Gradient {
          0% {
            background-position: 30% 40%
          }
          50% {
            background-position: 100% 50%
          }
          100% {
            background-position: 0% 80%
          }  
        }
   

    .button{

    /*background-color: #181818; */
    background-color: transparent; 
    color: #d6d6d6;
    border: 2px solid #d6d6d6;
    padding: 10px 25px;
    margin-top: 10%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 0.2em; 
    font-family: Times new Roman;
    -webkit-transition-duration: 0s;

    }

    .button:hover {
      box-shadow: 0 12px 16px 0 rgba(255,255,255,0.24), 0 17px 50px 0 rgba(255,255,255,0.19);
      /*box-shadow: 0 12px 16px 0 rgba(218,165,32,0.24);*/
      background-color: rgba(255, 255, 255, 0.7);
      color: #000000;
      /*border-color: #daa520;*/
      
   }

    fieldset{

      margin-top: 6.5%;
      margin-left: 11%;
      position: absolute;
      width: 1070px;
      height: 520px;
      /*border-radius: 0.25em ;*/
      border-color: transparent; 
      background-color: rgba(0, 0, 0, 0.5);
      box-shadow: 3px 3px rgba(0,0,0,0.2);
      color: #d3d3d3;
      position: absolute;
    }


    #more
    {
        cursor: pointer;
    }

  </style>   
</head>   

        <body>

         <fieldset>

          <div style = "height: 50px; margin-left: -45%; margin-top: -6.3%;">
            <img src = "lantern.png">
          </div>
          <div style = "height: 50px; margin-left: 23%; margin-top: -4.7%;">
            <img src = "lantern.png">
          </div>

            <div style = "margin-top: 9%; margin-bottom: 6%; color:#bbbbbb;">
               <?php echo "<center> Welcome &nbsp;{$user_check}!<center/>"; ?>
            </div>

                 <form action = "Welcome.php" method = "post">
                    <center>
                        <div style = "margin-top: -7.5%;">
                          <input type="button" value="Register" class = "button" id = "more" align = "center" onclick="window.location.href='Register.php'" />
                          <input type="button" value="Categories" class = "button" id = "more" align = "center" onclick="window.location.href='Categories.php'" />
                          <input type="button" value="Cat-Heads" class = "button" id = "more" align = "center" onclick="window.location.href='Cat_Heads.php'" /><br/>
                        </div>
                        <div style = "margin-top: -4.5%;">  
                          <input type="button" value="Judges" class = "button" id = "more" align = "center" onclick="window.location.href='Judges.php'" />
                          <input type="button" value="Search" class = "button" id = "more" align = "center" onclick="window.location.href='Search.php'" />
                          <input type="button" value="Delete" class = "button" id = "more" align = "center" onclick="window.location.href='Delete.php'" /><br/>
                        </div>
                        <div style = "margin-top: -4.8%; margin-left: -0.5%;">
                          <input type="button" value="Change Password" class = "button" id = "more" align = "center" onclick="window.location.href='Update.php'" />
                          <input type="button" value="Sign Out" class = "button" id = "more" align = "center" onclick="window.location.href='Logout.php'" />
                        </div>
                    </center>
                    
                 </form>

            </fieldset>
            
        </body>
</html>




