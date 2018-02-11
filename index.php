<?php
require_once("dbconfig.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Yunhee</title>

  <link rel="stylesheet" href="./css/board.css" />
</head>
<body>
  <article class="boardArticle">
    <h3>Yunhee Channel Admin</h3>
    <div id="boardList">

      <table>
        <caption class="readHide">Admin Page</caption>
        <thead>
          <tr>

            <th scope="col" class="title">제목</th>
            <th scope="col" class="title2">삭제</th>
            <th scope="col" class="title2">이미지</th>
          </tr>
        </thead>
        <tbody>
<?php
$sql = 'select * from board_free';
$result = $db->query($sql);
while($row = $result->fetch_assoc())
{

?>
            <tr>

              <td class="title">
                <a href="write.php?bno=<?php echo $row['b_no']?>"><?php echo $row['b_title']?></a>
              </td>
              <td class="title2">
                <a href="view.php?bno=<?php echo $row['b_no']?>">삭제</a>

              </td>

              <td class="title">

                <iframe width="350px" height="125px" src="brandimg.php?bno=<?php echo $row['b_no']?>" name="iframe_a"></iframe>
              </td>
            </tr>
<?php
}
?>
        </tbody>
      </table>
      <div style="float:right; height:100px;"> 
        <form action="write_update.php" method="post" enctype="multipart/form-data">
          브랜드 이름을 먼저 등록해주세요 <input type="text" name="bTitle" id="bTitle" >
          <input style="color:blue;font-size:40px;" type="submit" value="Add">
        </form>

      <p><a href="MyChannel.php" target="blank">Go to MyChannel</a></p>
      </div>


    </div>

  </script>
</article>
</body>
</html>
