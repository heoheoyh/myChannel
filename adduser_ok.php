<?php

$mysqli = new mysqli('localhost:8889', 'root', 'root', 'test');
if (mysqli_connect_error()) {
  exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}



extract($_POST);


$q = "SELECT * FROM login WHERE email='$email'";
$result=$mysqli->query( $q);
if($result->num_rows==1){
  $row=$result->fetch_array(MYSQLI_ASSOC);
  if($row['email']==$email){
    echo "<script>alert('<$email>는 이미 존재하는 메일입니다.'); history.back();</script>";
    exit;
  }

}


$q = "INSERT INTO login ( first, last, pw, email) VALUES ( '$first', '$last' ,'$pw' , '$email' )";




$mysqli->query( $q);

$mysqli->close();

echo "<meta http-equiv='refresh' content='0; url=MyChannel.php'>"; 
echo "<script>alert('새로운 User로 추가되었습니다');</script>";

?>