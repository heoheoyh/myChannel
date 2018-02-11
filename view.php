<?php

require_once("dbconfig.php");
$bno = $_GET['bno'];

$sql = 'select b_title, b_content, b_date from board_free where b_no = ' . $bno;
$result = $db->query($sql);
	//$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Mforest</title>

	<script type="text/javascript">

	function init(){

		var linkPage = document.getElementById('visit').href;
		window.location.href = linkPage;
	}

	onload=init;

	</script>
</head>
<body>

	<article class="boardArticle">
		<h3>Automatically go to delete</h3>
		<div id="boardView">
			
			<a id="visit" href="delete.php?bno=<?php echo $bno?>">삭제</a>

		</div>
	</article>

</body>
</html>