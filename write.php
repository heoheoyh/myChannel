
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
	$sql = 'select b_title, b_content,main_url, name,hash from board_free where b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();


	
	
}

$query = 'select thum_hash, thum_id, url from thumnail where b_no= ' . $bNo;
$result2 = $db->query($query);
$num_result = $result2->num_rows;



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Yunhee</title>
	
	<link rel="stylesheet" href="./css/board.css" />
	<style type="text/css">
	.text{

		width: 60px;
		height: 60px;
		opacity:0;
	}

	.pic:hover .text{
		opacity:1;
		text-align: justify;
		color:black; 
		
		font-weight:700; 
		
	}

	</style>
</head>
<body>
	<article class="boardArticle">
		<h3>Yunhee Channel Admin</h3>
		
		<div id="boardWrite">
			<form action="write_update.php" method="post" enctype="multipart/form-data">
				<?php
				if(isset($bNo)) {
					echo '<input type="hidden" name="bno" value="' . $bNo . '">';
				}
				
				?>
				<table id="boardWrite">
					<caption>Add/Update</caption>
					<tbody>
						<tr>
							<th scope="row"><label for="bTitle">Title</label></th>
							<td class="title"><input type="text" name="bTitle" id="bTitle" value="<?php echo isset($row['b_title'])?$row['b_title']:null?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="bContent">keyword</label></th>
							<td class="content"><textarea name="bContent" id="bContent"><?php echo isset($row['b_content'])?$row['b_content']:null?></textarea></td>
						</tr>
						<tr>

							
							<th scope="row"><label for="bimg">brand img</label></th>
							<td>
								<?php echo "<img style=''. src='files/".$row['hash']."' width='130' height='130' />" ?></td>
							

						</tr>
						<tr>
							<th scope="row"><label for="bTitle">Channel URL</label></th>
							<td class="title"><input type="url" name="main_url" id="bTitle" value="<?php echo isset($row['main_url'])?$row['main_url']:null?>"></td>
						</tr>
						<tr>							
							<th scope="row"><label for="bimg">thumnails</label></th>
							<td>
								<button type="button" id="add-btn">Add</button>
								<button type="button" id="del-btn">Del</button>
								<div class="thumb-input-cont"></div>
								

								<?php
								for($i=0; $i<$num_result; $i++)
								{
									$row = $result2->fetch_assoc();


									echo "<span class='pic'><a href='thumb_del.php?thum_id=".$row['thum_id']."'><img style=''. src='files/".$row['thum_hash']."' width='60' height='60' /></a><span class='text'>삭제</span></span>";
									echo "<div>".$row['url']."</div>";
								}

								?>
								<button type="button" id="thumb-submit">썸네일 등록하기</button>
							</td>
						</tr>

					</tbody>
				</table>

				<div class="btnSet">
					<button type="submit">
						<?php echo isset($bNo)?'수정':'작성'?>
					</button>

					<a href="index.php">목록</a>
				</div>

			</form>
		</div>

	</article>
	<script src="jquery-1.11.3.min.js"></script>
	<script src="lodash.js"></script>
	<script>
	$(document).ready(function() {
		function GetURLParameter(sParam) {
			var sPageURL = window.location.search.substring(1);
			var sURLVariables = sPageURL.split('&');
			for (var i = 0; i < sURLVariables.length; i++) {
				var sParameterName = sURLVariables[i].split('=');
				if (sParameterName[0] == sParam) {
					return sParameterName[1];
				}
			}
		}

		var htmlTpl = $('.thumb-tpl').html();
		var compileHtml = _.template(htmlTpl);

		$('#add-btn').on('click', function(){
			$('.thumb-input-cont').append(compileHtml());
		});

		$('#del-btn').on('click', function(){
			$('.thumb-input-cont .myform :checked').parent().remove();
		});



	// var fileData = new FormData();
		// $.each($('.thumbnail')[0].files, function(i, file) {
		// 	fileData.append('file-'+i, file);
		// });


	var fileData = new FormData();
	$('#thumb-submit').on('click', function() {
		$('.myform').each(function(i, el) {
			var $this = $(el);
			fileData.append('file-'+i, $this.find('.thumbnail')[0].files[0]);
			fileData.append('url-'+i, $this.find('.url').val());
		});
		fileData.append('bno', GetURLParameter('bno')); 

		$.ajax({
			method: "POST",
			url: "thumb_upload.php",
			data: fileData,
			cache: false,
			contentType: false,
			processData: false,
		})
		.done(function( msg ) {
			alert("Success Thumbnails!");
			location.replace("<?php echo 'write.php?bno='.$bNo.''?>");
			console.log(msg);
		});
	});





});
</script>

<script type="text/template" class="thumb-tpl">

<div class="myform">
<input type="checkbox" />
Add Thum<input type="file" name="file" multiple="multiple" class="thumbnail"/><br/>
Link URL<input type="url"  name="url" class="url" required />
</div>

</script>
</body>
</html>