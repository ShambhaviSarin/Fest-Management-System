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
      
      

      $query = "SELECT * FROM Events WHERE Category_id = 104 ";
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
            $message = "<center><table><tr> <th>Category ID&nbsp;&nbsp;&nbsp;&nbsp;</th> <th>Event ID</th> <th>Event Name</th>  <th>Day</th> <th>&nbsp;&nbsp;&nbsp;&nbsp;Duration(hrs)</th> <th>&nbsp;&nbsp;&nbsp;&nbsp;Room Number</th> </tr>";

            while ($row = mysqli_fetch_assoc($result)) 
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
      <title>Ergo</title>
      
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
          margin-left: 16%;
          position: absolute;
          width: 950px;
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
         margin-top: 2%;
         font-family: Georgia;
         font-size: 20px;
         text-align: center;
        }

        td {
         padding:15px 18px 3px 18px;
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
              <div style = " margin-left: 85%; margin-top: -3%">
                <img src="b1.svg" id = "rot1" height = "590">
              </div>
              <div style = " margin-top: -58%; margin-left: -70%;">
                <img src="b1.svg" id = "rot" height = "590">
              </div>

              <div style = "margin-top: -58%; margin-left: -1%;; color:#fbfbfb; font-size: 30px;"><center><i>Ergo</i></center></div>  
                 
                 <div style = "color:bbbbbb; font-size:18px;" align = "left">
                    <center><?php echo "  $message " ?></center><br />
                 </div> 

                 <form action = "Ergo.php" method = "post">
                  <div style = "font-size: 18px; color:#fbfbfb; margin-top: 5%; " align = "center" >
                     <?php echo "Kindly note the Event ID of the event you want to register for. "; ?></br>
                  </div>
                  <div style = "margin-top: 0%; margin-left: 31%;">
                     <input type="button" value="Register" class = "button" id = "more" align = "center" onclick="window.location.href='Event_Reg.php'" />
                     <input type="button" value="Sign Out" class = "button" id = "more" align = "center" onclick="window.location.href='Logout.php'" />         
                     <input type="button" value="Back" class = "button" id = "more" align = "center" onclick="window.location.href='Categories.php'" />         
                  </div>
               </form>

                 

               </fieldset>
              
           </body>
   </html>