<?php
//echo json_encode($_POST);
$bno = $_POST["bno"];
echo json_encode($_POST);


date_default_timezone_set('Asia/Seoul');
// if(!$_FILES['file']['name'])
// {
// 	echo "<script>alert('upload file not exist');";
// 	echo "history.back();</script>";
// 	exit;
// }

// if(strlen($_FILES['file']['name']) > 255)
// {
// 	echo "<script>alert('파일 이름이 너무 깁니다.');";
// 	echo "history.back();</script>";
// 	exit;
// }



@$db = new mysqli('localhost:8889', 'root', 'root', 'test');
if(mysqli_connect_errno())
{
	echo "DB error";
	exit;
}

for ($i = 0; $i < count($_FILES); $i++) {
	$file = $_FILES["file-".$i];
	$url = $_POST["url-".$i];

	$date = date("YmdHis", time());
	$dir = "files/";
	$file_hash = $date.$file['name'];
	$file_hash = md5($file_hash);
	$upfile = $dir.$file_hash;
	

	if(is_uploaded_file($file['tmp_name']))
	{
		if(!move_uploaded_file($file['tmp_name'], $upfile))
		{
			echo "upload error";
			exit;
		}
	}

	$query = "insert into thumnail (b_no, thum_name, thum_hash, url) 
	values('".$bno."','".$file['name']."','".$file_hash."','".$url."')";

//	$query = "insert into thumnail (b_no, thum_name, thum_hash, url) 
//	values('".$bno."','".$file['name']."','".$file_hash."','".$url."')";

	$result = $db->query($query);
	if(!$result)
	{
		echo "DB upload error";
		exit;
	}

}


$db->close();


// echo "<script>alert('success');";

// echo "location.replace('list.php'); </script>"
?>