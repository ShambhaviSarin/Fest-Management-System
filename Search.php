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


<html>
   
   <head>
      <title>Search</title>

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

      width: 452px;
      height: 50px;
      margin-top: 3%;
      margin-left: -42.65%;
      background-color: transparent;
      opacity:0.9;
      border: 2px solid rgba(255, 255, 255, 0.5);
      border-right-color: transparent;
      border-left-color:transparent;  
      position: absolute;
      color: #bbbbbb;

    }

    .button{

    background-color: transparent; 
    color: #d6d6d6;
    border: 2px solid rgba(255, 255, 255, 0.7);
    padding: 10px 25px;
    margin-top: 14%;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 0.2em; 
    font-family: Times new Roman;
    -webkit-transition-duration: 0s;
    margin-left: 3.5%;
    /*width: 120px;*/

    }

    .button:hover {
      box-shadow: 0 12px 16px 0 rgba(255,255,255,0.24), 0 17px 50px 0 rgba(255,255,255,0.19);
      background-color: rgba(255, 255, 255, 0.7);
      color: #000000;
   }

    fieldset{

      margin-top: 11%;
      margin-left: 33%;
      position: absolute;
      width: 440px;
      height: 350px;
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

    #icon{
     width: 36px;
     margin-left: -49.7%;
     margin-top: -0.7%;
     position: absolute;
     height: 46px;
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

  <?php $icon = "<b class='fa fa-question-circle-o' aria-hidden='true'></b>"?> 
   </head>
   <body>

         <fieldset>

          <div style = "margin-left: 133%; margin-top: 28%;">
            <img src = "border.png">
          </div>
          <div style = "margin-left: -115%; margin-top: -164%;">
            <img src = "border.png" id = "rot">
          </div>

          <div style = "margin-top: -47%; margin-left: -3%;; color:#bbbbbb; font-size: 30px;"><i><center>Search</center></i></div>

              <br />
              

              <form action = "Searched.php" method = "post">
                  <div style = "margin-top: -2%;">
                     <table align = "center">
                  
                      <tr>
                      
                        <td style="color:white; margin-left:-20%;"><div class = "box" id = "icon"><?php echo $icon;?></div></td>
                        <td><input type = "text" name = "Search" class = "box" placeholder = "Search by Delegate number, Registration number, Event ID, Category ID, Judge ID"/></br></br></td>
                      </tr>
                     </table>   
                  </div>
                  <div style = "margin-top: 4%; margin-left: 3%;">
                     <input type = "submit" name = "submit" value = " Search " class = "button" id = "more" align = "center" onclick="window.location.href='Searched.php' "/>
                     <input type="button" value="Sign Out" class = "button" id = "more" align = "center" onclick="window.location.href='Logout.php'" /> 
                     <input type="button" value="Back" class = "button" id = "more" align = "center" onclick="window.location.href='Welcome.php'" />

                  </div>
               </form>

               
              

            </fieldset>
          
        </body>
</html>

   
   
                   
         
                    
         
               
               
               