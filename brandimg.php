<?php
require_once("dbconfig.php");
// @ $db = new mysqli('localhost', 'root', 'Yu08057373', 'test');
// if(mysqli_connect_errno())
// {
// 	echo "DB connect error";
// }
	//$_GET['bno']이 있을 때만 $bno 선언
if(isset($_GET['bno'])) {
	$bNo = $_GET['bno'];
}

if(isset($bNo)) {
	$sql = 'select name, hash from board_free where b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();


	
	
}
?>

<!DOCTYPE html>
<head><meta charset="utf-8" /></head>
<body>
	<form action="brandimg_update.php" method="post" enctype="multipart/form-data">
		<input type="file" name="file">
		<input type="submit" value='등록하기'>
		<?php
		if(isset($bNo)) {
			echo '<input type="hidden" name="bno" value="' . $bNo . '">';
		}

		?>

		<?php
		echo "<img style=''. src='files/".$row['hash']."' width='80' height='80' />";

		?>




	</form>
</body>
</html>