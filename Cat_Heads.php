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
      

      $query = "SELECT * FROM Categories";
      $result = mysqli_query($connection,$query);
      if(!$result)
      {
         die("Database query failed");
      }
      
      $count = mysqli_num_rows($result);

      if(empty($errors))
      {
         if($count > 0)
         {
            $message = "<center><table><tr> <th>Category ID&nbsp;&nbsp;</th> <th>Cat-Head</th> <th>Contact Number</th> </tr>";

            while ($row = mysqli_fetch_assoc($result)) 
            {
               $message .= "<br/><tr><td>{$row['Category_id']}</td>";
               $message .= "<td>{$row['Cat_Name']}&nbsp;&nbsp; </td>";
               $message .= "<td>&nbsp;&nbsp;{$row['Cat_phone']} </td></tr>";
            }

            $message .= "</table></center>";
         }
         
         else
         {
            $message = "No records found.";
         }
      }
      else
      {
         $message = "Invalid action";
      }

?>
<html>
   
   <head>
      <title>Cat-Heads</title>
      
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

        }

        .button:hover {
          box-shadow: 0 12px 16px 0 rgba(255,255,255,0.24), 0 17px 50px 0 rgba(255,255,255,0.19);
          background-color: rgba(255, 255, 255, 0.7);
          color: #000000;
       }

        fieldset{

          margin-top: 5%;
          margin-left: 21%;
          position: absolute;
          width: 770px;
          height: 560px;
          /*border-radius: 0.25em ;*/
          border-color: transparent; 
          background-color: rgba(0, 0, 0, 0.5);
          box-shadow: 3px 3px rgba(0,0,0,0.2);
          color: #d3d3d3;
          position: absolute;
        }

        table{
         color: #f0f0f0;
         margin-top: -6%;
         font-family: Georgia;
         font-size: 20px;
         text-align: center;
        }

        td {
         padding:15px 18px 3px 20px;
         text-align: center;
         margin-top: 5%;
         font-family: Times New Roman;
        }
        tr {
         margin-top: 12%;
        }
        th {
         margin-bottom: 5%;
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

      </style>    
   </head>
           <body>

            <fieldset>
              <div style = " margin-left: 92%; margin-top: -4%">
                <img src="b1.svg" id = "rot1" height = "590">
              </div>
              <div style = " margin-top: -70%; margin-left: -95%;">
                <img src="b1.svg" id = "rot" height = "590">
              </div>

              <div style = "margin-top: -72%; margin-left: -1%;; color:#fbfbfb; font-size: 30px;"><center><i>Cat-Heads</i></center></div>  
                 
                 <div style = "color:bbbbbb; font-size:18px;" align = "left">
                    <center><?php echo "  $message " ?></center><br />
                 </div> 

                 <form action = "Cat_Heads.php" method = "post">
                  <div style = "margin-top: -2%; margin-left: 34%;">
                     <input type="button" value="Sign Out" class = "button" id = "more" align = "center" onclick="window.location.href='Logout.php'" />         
                  </div>
                  <div style = "margin-left: 54%; margin-top: -10.2%;">
                     <input type="button" value="Back" class = "button" id = "more" align = "center" onclick="window.location.href='Welcome.php'" />         
                  </div>
               </form>

                 

               </fieldset>
               
           </body>
   </html>