
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>高城美容美學教育學院loftycity</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/dhtmlxcalendar.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/dhtmlxcalendar.js"></script>
    <script type="text/javascript" src="js/bookRoom.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/apply.js"></script>
    <script type="text/javascript" src="js/home.js"></script>
  </head>

  <body onload="doOnLoad();">

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#home">高城美容美學教育學院</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active" id="liHome"><a id="mHome" href="#home" onClick="showLayer(this,'home','liHome');">首頁</a></li>
              <li id="liBook"><a id="mBook" href="#book" onClick="showLayer(this,'book','liBook');">教室預訂</a></li>
              <!--<li id="liContact"><a id="mContact" href="#contact" onClick="showLayer(this,'shopList','liContact');">商品列表</a></li>-->
              <?php if (($_COOKIE['userType'] == 'admin') || ($_COOKIE['userType'] == 'member')) {?>
              <li id="liMember" style="display:none" class="dropdown"><a id="mMember" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown" >會員中心<b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="mMember">
                  <li role="presentation"><a id="a_Manage" role="menuitem" tabindex="-1" href="#" onClick="showLayer(this,'m_Manage','liMember');">訂單查詢</a></li>
                  <li role="presentation"><a id="a_showPoint" role="menuitem" tabindex="-1" href="#" onClick="showLayer(this,'showPoint','liMember');">點數記錄</a></li>
                  <li role="presentation"><a id="a_memberUpdate" role="menuitem" tabindex="-1" href="#" onClick="showLayer(this,'memberUpdate','liMember');">會員資料修改</a></li>
                  <?php if ($_COOKIE['userType'] == 'admin') {?>
                  <li role="presentation"><a id="p_add" role="menuitem" tabindex="-1" href="#" onClick="showLayer(this,'addPoint','liMember');">點數儲值</a></li>
                  <?php } ?>
                </ul>
              </li>
              <?php } ?>
            </ul>
            <form class="navbar-form pull-right" >
              <div id="userDiv" style="display:none">
                <a class="brand" id="user"></a>
                <a class="brand" id="point"></a>
                <button type="submit" class="btn" id="logout">登出</button>
              </div>
              <div id="loginDiv">
                <input class="span2" type="text" placeholder="帳號" id="l_username">
                <input class="span2" type="password" placeholder="密碼" id="password">
                <button type="submit" class="btn" id="login">登入</button>
                <button type="submit" class="btn" id="apply" data-toggle="modal" data-target="#applyDia">申請</button>
              </div>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div id="home">
        <div class="hero-unit">
          <h1><img src="img/loftycity.jpg" >高城美容美學教育學院</h1>
          <p>線上服務平台</p>
          <!-- <p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
        </div>

      <!-- Example row of columns -->
        <div class="row">
          <div class="span4">
            <h2>教室預訂/查詢</h2>
            <p>提供上線查詢與預訂教室功能</p>
            <p><a class="btn btn-primary" href="#" onClick="showLayer(this,'book','liBook');">立刻前往 &raquo;</a></p>
          </div>
          <div class="span4">
            <h2>商品列表</h2>
            <p>功能未上線</p>
            <p><a class="btn btn-primary" href="#" onClick="showLayer(this,'shopList','liContact');">立刻前往 &raquo;</a></p>
          </div>
          <div class="span4" id="about">
            <h2>會員中心</h2>
            <p>可透過平台申請會員，登入後才可進行預訂及會員相關操作</p>
            <?php if (($_COOKIE['userType'] == 'admin') || ($_COOKIE['userType'] == 'member')) {?>
            <p><a class="btn btn-primary" href="#" onClick="showLayer(this,'m_Manage','liMember');">立刻前往 &raquo;</a></p>
            <?php } ?>
          </div>
        </div>
      </div>

      <div id="book" style="display:none">
        <div class="hero-unit">
          <h1>教室預訂</h1>
          <p>如欲預訂教室，請先選擇日期後點選查詢，並於時間表中點選您欲租借的教室與對應時間，紅色區間為已被預訂時間無法點選，點選後出現藍色區間為您選擇的教室時間，選擇完畢後點選預訂，便完成預訂。</p>
          <p>若沒有預訂按鈕，請先登入會員！</p>
        </div>

      <!-- Example row of columns -->
        <div class="row">
          <div class="span12">
            <form class="navbar-form" style="text-align:center">
              <input class="span2" type="text" id="calendar_input" placeholder="2014-01-01">
              <span><img id="calendar_icon" src="./img/dhxcalendar_skyblue/calendar.gif" border="0"></span>
              <button type="submit" class="btn" id="searchRoom">查詢</button>
              <?php if (($_COOKIE['userType'] == 'admin') || ($_COOKIE['userType'] == 'member')) {?>
              <button type="submit" class="btn" id="bookRoom">預訂</button>
              <?php } ?>
            </form>
            <br>
            <table id="tfhover" class="table table-striped table-bordered" align="center">
              <caption></caption>
                <tr>
                  <td></td>
                  <td>教室一</td>
                  <td>教室二</td>
                  <td>教室三</td>
                  <td>教室四</td>
                  <td>教室五</td>
                  <td>教室六</td>
                  <td>教室七</td>
                </tr>
                <?php for($j = 0 ; $j < 10 ; $j++) { 
                  echo "<tr>";
                  for($i = 0 ; $i < 8 ; $i++){
                    echo "<td id='".($i*100+$j+1)."'>";
                    if($i == 0){
                      echo ($j+8).":00~".($j+8+1).":00";
                    } 
                    echo "</td>";
                  }
                  echo"</tr>";
                } ?>
            </table>
          </div>
        </div>
      </div>

      <div id="shopList" style="display:none">
        <div class="hero-unit">
          <h1>商品列表</h1>
          <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
          <p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>
        </div>

      <!-- Example row of columns -->
        <div class="row">
          <div class="span4">
            <h2>商品列表</h2>
            <p>功能未上線</p>
            <p><a class="btn btn-primary" href="#" onClick="showLayer(this,'shopList','liContact');">立刻前往 &raquo;</a></p>
          </div>
          <div class="span4">
            <h2>商品列表</h2>
            <p>功能未上線</p>
            <p><a class="btn btn-primary" href="#" onClick="showLayer(this,'shopList','liContact');">立刻前往 &raquo;</a></p>
          </div>
          <div class="span4">
            <h2>商品列表</h2>
            <p>功能未上線</p>
            <p><a class="btn btn-primary" href="#" onClick="showLayer(this,'shopList','liContact');">立刻前往 &raquo;</a></p>
          </div>
          <div class="span4">
            <h2>商品列表</h2>
            <p>功能未上線</p>
            <p><a class="btn btn-primary" href="#" onClick="showLayer(this,'shopList','liContact');">立刻前往 &raquo;</a></p>
          </div>
        </div>
      </div>

      <?php if (($_COOKIE['userType'] == 'admin') || ($_COOKIE['userType'] == 'member')) {?>
      <div id="m_Manage" style="display:none">
        <div class="hero-unit">
          <h1>訂單查詢</h1>
          <p></p>
        </div>

      <!-- Example row of columns -->
        <div class="row">
          <div class="span12">
            <table id="searchBookedTable" class="table table-striped table-bordered" align="center">
              <caption></caption>
                <tr>
                  <td>日期</td>
                  <td>預訂教室</td>
                  <td>下訂時間</td>
                  <td>訂單狀態</td>
                  <td>管理</td>
                </tr>
            </table>
          </div>
        </div>
      </div>

      <div id="showPoint" style="display:none"><?php include_once('showPointEvent.php'); ?></div>  

      <div id="memberUpdate" style="display:none"><?php include_once('memberUpdate.php'); ?></div>    
      <?php } ?>

      <?php if ($_COOKIE['userType'] == 'admin') {?>
      <div id="addPoint" style="display:none"><?php include_once('addPoint.php'); ?></div>
      <?php } ?>

      <hr>

      <?php if (($_COOKIE['userType'] != 'admin') && ($_COOKIE['userType'] != 'member')) {?>
        <!-- Modal -->
      <div class="modal hide fade " id="applyDia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">帳號申請</h4>
            </div>
            <div class="modal-body">
                <p><strong>使用帳號</strong>：
                <input name="m_username" type="text" class="form-control" id="m_username">
                <font color="#FF0000">*</font><br>
                <span class="smalltext">請填入5~12個字元以內的小寫英文字母、數字、以及_ 符號。</span></p>
                <p><strong>使用密碼</strong>：
                <input name="m_passwd" type="password" class="form-control" id="m_passwd">
                <font color="#FF0000">*</font><br>
                <span class="smalltext">請填入5~10個字元以內的英文字母、數字、以及各種符號組合，</span></p>
                <p><strong>確認密碼</strong>：
                <input name="m_passwdrecheck" type="password" class="form-control" id="m_passwdrecheck">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext">再輸入一次密碼</span></p>
                <hr size="1" />
                <p class="heading">個人資料</p>
                <p><strong>真實姓名</strong>：
                <input name="m_name" type="text" class="form-control" id="m_name">
                <font color="#FF0000">*</font> </p>
                <p><strong>性　　別</strong>：
                <input name="m_sex" type="radio" value="女" id="m_sex" checked>女
                <input name="m_sex" type="radio" value="男" >男
                <font color="#FF0000">*</font></p>
                <p><strong>生　　日</strong>：
                <input name="m_birthday" type="text" class="form-control" id="m_birthday">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext">為西元格式(YYYY-MM-DD)。</span></p>
                <p><strong>電子郵件</strong>：
                <input name="m_email" type="text" class="form-control" id="m_email">
                <font color="#FF0000">*</font> </p>
                <p class="smalltext">請確定此電子郵件為可使用狀態，以方便未來系統使用，如補寄會員密碼信。</p>
                <p><strong>電　　話</strong>：
                <input name="m_phone" type="text" class="form-control" id="m_phone"></p>
                <p><strong>住　　址</strong>：
                <input name="m_address" type="text" class="form-control" id="m_address" size="40"></p>
                <p> <font color="#FF0000">*</font> 表示為必填的欄位</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
              <button type="button" class="btn btn-primary" id="sendApply">送出申請</button>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>

      <footer>
        <p align="center">&copy; 2014 By megshao</p>
      </footer>
    </div> 
  </body>
</html>
