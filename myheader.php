 <?php 

 session_start();
 require_once("dbconfig.php");
 $query = "SELECT board_free.* from board_free";
 $result = $db->query($query);
 $result2 = $db->query($query);
 $num_result= $result->num_rows;
 $num_result2= $result2->num_rows;
 ?>

 <style type="text/css">
 .input-field input[type=password]:focus + label,
 .input-field input[type=email]:focus + label, 
 .input-field input[type=text]:focus + label{
   color: #ff4081;
 }
 </style>
 <nav class="pink" role="navigation">
  <div class="nav-wrapper container"><a id="logo-container" href="MyChannel.php" class="brand-logo">Yunhee Channel</a>
    <ul class="right hide-on-med-and-down">
     <?php if (isset($_SESSION['is_logged'])) { ?>
     <li><a href="logout.php">Logout</a></li>
     <li><a href="AddUser.php">AddUser</a></li>
     <li><a href="index.php" target="blank">GoToAdmin</a></li>
     <?php } 
     else { ?>
     <li><a class="modal-trigger" href="#modal1">Login</a></li>
     <?php } ?>
   </ul>


   <ul id="nav-mobile" class="side-nav">
    <?php if (isset($_SESSION['is_logged'])) { ?>
    <li><a href="logout.php">Logout</a></li>
    <li><a href="AddUser.php">AddUser</a></li> 
    <?php }  else { ?>
    <li><a class="modal-trigger" href="#modal1">Login</a></li> <?php } ?>
    <li> <a id="kakao-link-btn" href="javascript:;">Share<img src="kakaotalk.png" style="width:25px;" /></a></li>
  </ul>

  <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
</div>
</nav>
<div id="modal1" class="modal" style="width:400px;">
  <div class="row">
    <form class="col s12" method="post" action="login_ok.php" style="color:black;">
      <div class="modal-content">
        <div class="row" >
          <div class="row">
            <div class="input-field col">
              <input id="password" type="password" class="validate" name="pw">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col6">
              <input id="email" type="email" class="validate" name="email">
              <label for="email" >Email</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
       <button class="white btn-flat pink-text text-accent-2" type="submit" name="action">Submit</button>
       <button type="button" class=" modal-action modal-close btn-flat white ">Cancel</button>
     </div>
   </form>
 </div>
</div>


<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="bower_components/Materialize/dist/js/materialize.min.js"></script>
<script type="text/javascript">
(function($, Kakao){
  $(function(){
    initKakao();
    $('.modal-trigger').leanModal();
    $('.button-collapse').sideNav();


    function initKakao() {
      // 사용할 앱의 JavaScript 키를 설정해 주세요.
      Kakao.init('595e1ace656daab872b7be6b74c1c9e2');

      // 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
      Kakao.Link.createTalkLinkButton({
        container: '#kakao-link-btn',
        label: '윤희의 채널',
        image: {
          src: 'http://dn.api1.kage.kakao.co.kr/14/dn/btqaWmFftyx/tBbQPH764Maw2R6IBhXd6K/o.jpg',
          width: '300',
          height: '200'
        },
        webButton: {
          text: '카카오 디벨로퍼스',
          url: 'http://54.64.196.143:8880/WebAppAdmin/MyChannel.php' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
        }
      });
    }
  }); // end of document ready
})(jQuery, Kakao); // end of jQuery name space
</script>

