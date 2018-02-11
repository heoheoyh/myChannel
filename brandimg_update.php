<?php
//include('upload.php');
require_once("dbconfig.php");
date_default_timezone_set('Asia/Seoul');
	//$_POST['bno']이 있을 때만 $bno 선언
if(isset($_POST['bno'])) {
	$bNo = $_POST['bno'];
}

	//bno이 없다면(글 쓰기라면) 변수 선언
if(empty($bNo)) {
	$bID = $_POST['bID'];

	$date = date('Y-m-d H:i:s');
}

	//항상 변수 선언
$bPassword = $_POST['bPassword'];
// $bTitle = $_POST['bTitle'];
// $bContent = $_POST['bContent'];
date_default_timezone_set('Asia/Seoul');
    if(!$_FILES['file']['name'])
    {
        echo "<script>alert('upload file not exist');";
        echo "history.back();</script>";
        exit;
    }
    
    if(strlen($_FILES['file']['name']) > 255)
    {
        echo "<script>alert('파일 이름이 너무 깁니다.');";
        echo "history.back();</script>";
        exit;
    }
    
    $date = date("YmdHis", time());
    $dir = "files/";
    $file_hash = $date.$_FILES['file']['name'];
    $file_hash = md5($file_hash);
    $upfile = $dir.$file_hash;
 
    if(is_uploaded_file($_FILES['file']['tmp_name']))
    {
            if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile))
            {
                    echo "upload error";
                    exit;
            }
    }

//글 수정
if(isset($bNo)) {
	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	$sql = 'select count(b_password) as cnt from board_free where b_password=password("' . $bPassword . '") and b_no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	//비밀번호가 맞다면 업데이트 쿼리 작성
	if($row['cnt']) {
		$sql = 'update board_free set name="' . $_FILES['file']['name'] . '", hash="' . $file_hash  . '" where b_no = ' . $bNo;
		$msgState = '수정';
	//틀리다면 메시지 출력 후 이전화면으로
	} else {
		$msg = '비밀번호가 맞지 않습니다.';
		?>
		<script>
		alert("<?php echo $msg?>");
		history.back();
		</script>
		<?php
		exit;
	}
	
//글 등록
} 
//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	$result = $db->query($sql);
	
	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = 'success';
		if(empty($bNo)) {
			$bNo = $db->insert_id;
		}
		$replaceURL = 'brandimg.php?bno='.$bNo.'';
	} else {
		$msg = 'fail';
		?>
		<script>
		alert("<?php echo $msg?>");
		history.back();
		</script>
		<?php
		exit;
	}
}

?>
<script>
alert("<?php echo $msg?>");
location.replace("<?php echo $replaceURL?>");
</script>