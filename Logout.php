<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: Login.php");
   }
?>
<?php
	//5. Close database connection
	mysqli_close($connection);
?>