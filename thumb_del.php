<?php



if(!$_GET['thum_id'])
{
        echo "<script>alert('fail');";
        echo "history.back();</script>";
}

@ $db = new mysqli('localhost:8889', 'root', 'root', 'test');
if(mysqli_connect_errno())
{
        echo "DB connect error";
        exit;
}

$query = "select thum_hash from thumnail where thum_id=".$_GET['thum_id'];
$result = $db->query($query);
if(!$result)
{
        echo "select query error";
        exit;
}
$result = $result->fetch_assoc();

$dir = "files/";
$filehash = $result['thum_hash'];

// if(!unlink($dir.$filehash))
// {
//     echo "file delete error";
//     exit;
// }


$query = "delete from thumnail where thum_id=".$_GET['thum_id'];


$result = $db->query($query);


//$replaceURL = 'write.php?bno='.$bNo.'';

?>

<script>
alert("succeess");
window.location.replace(document.referrer);
 </script>

