<?php

session_start();
$mysqli = new mysqli('localhost:8889', 'root', 'root', 'test');
if (mysqli_connect_error()) {
  exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

extract($_POST); 

$q = "SELECT * FROM login WHERE email='$email'";
$result = $mysqli->query( $q);

if($result->num_rows==1) {

  $row = $result->fetch_array(MYSQLI_ASSOC);
  if( $row['pw'] == $pw) {

   $_SESSION['is_logged'] = 'YES';
   $_SESSION['email'] = $email;

   $lastname=$row['last'];

   echo "<meta http-equiv='refresh' content='0; url=MyChannel.php'>"; 
   echo "<script>alert('Hi $lastname');</script>";
   exit();
 }

 else{
  $_SESSION['is_logged'] = 'NO';
  $_SESSION['email'] = '';
  session_destroy();
  echo "<script>alert('you are not group');history.back();</script>";
  exit();
} 

}


?>
