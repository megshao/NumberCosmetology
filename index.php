
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>數字美容學院NumberCosmetology</title>
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

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../ico/favicon.png">
    <link rel="stylesheet" type="text/css" href="css/dhtmlxcalendar.css"/>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/dhtmlxcalendar.js"></script>
    <script type="text/javascript" src="js/bookRoom.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/apply.js"></script>
    <script type="text/javascript">
      var saveID = new Array();
      var sBookItem;
      $(document).ready(function(){
        if(getCookie("stat") != "success"){
          $("#login").click(function(){  
            var username=$("#l_username").val();
            var password=$("#password").val();
            $.ajax({
              type: "GET",
              url: "./api/login.php?username="+username+"&passwd="+password,
              dataType : "json",
              success: function(json){    
                if(json["info"]=="success"){
                  document.cookie = "stat=success; " ; 
                  document.cookie = "user="+username+"; ";
                  window.location.reload(true);
                }
                else{
                  alert("帳號或密碼錯誤！");
                  document.getElementById('l_username').value="";
                  document.getElementById('password').value="";
                }
              },
              error: function() {
                 alert("error");
              }
            });
          return false;
          });
        }
        else{
          document.getElementById('userDiv').style.display='';
          document.getElementById('loginDiv').style.display='none';
          document.getElementById('user').innerHTML=getCookie("user");
          document.getElementById('liMember').style.display="block";
          $("#logout").click(function(event) {
            document.cookie = "stat=;";
            document.cookie = "user=;";
            document.getElementById('userDiv').style.display='none';
            document.getElementById('loginDiv').style.display='';
            document.getElementById('liMember').style.display='none';
          });
        }

        $("#searchRoom").click(function(event) {
          var date = $("#calendar_input").val();
          var iUser = $("#user").val();
            sBookItem = new bookItem(date,iUser);
            $.ajax({
              url: './api/getBooked.php?fun=date&date='+date,
              type: 'GET',
              dataType: 'json',
              success: function(json){
                if(saveID.length!=0 ){
                  for(var i = 0 ; i < saveID.length ; i++){
                      if(saveID[i] % 2 == 0)
                        document.getElementById(saveID[i]).style.background="#f9f9f9";
                      else
                        document.getElementById(saveID[i]).style.background="";
                    }
                }
                if(json["stat"]==true){
                  if(json["bookedRooms"]!=''){
                      saveID = json["bookedRooms"].split(";");
                      for(var i = 0 ; i < saveID.length ; i++){
                       document.getElementById(saveID[i]).style.background="#da4f49";
                    }
                  }
                }
                else{
                  alert("false");
                }
              },
              error: function(){
                alert("error");
              }
            });
          
        });

        $("#bookRoom").click(function(event) {
          sBookItem.rooms = sBookItem.rooms.substring(0,sBookItem.rooms.lastIndexOf(";"));
          sBookItem.user = getCookie(user);
          alert(sBookItem.user);
          if(sBookItem.user != ""){
          alert(sBookItem.user);
          $.ajax({
            url: './api/bookRooms.php?date='+sBookItem.date+'&rooms='+sBookItem.rooms+'&user='+sBookItem.user,
            type: 'GET',
            dataType: 'json',
            success: function(json){
              if(json["stat"]==true){
                alert("true");
                document.getElementById("searchRoom").click();
              }
              else
                alert("false");
            },
            error: function(){
              alert("error");
            }
          });
          }
          else{
            alert("請先登入會員！");
          }
        });

        $("#sendApply").click(function(event) {
          if(checkForm()){
            var sex ;
            if(document.getElementById('m_sex').checked)
              sex = '女';
            else
              sex = '男';        
            $.ajax({
              url: './api/addMember.php?username='+document.getElementById('m_username').value+'&passwd='+document.getElementById('m_passwd').value
                    +'&name='+document.getElementById('m_name').value+'&sex='+sex+'&birthday='+document.getElementById('m_birthday').value
                    +'&email='+document.getElementById('m_email').value+'&phone='+document.getElementById('m_phone').value+'&address='+document.getElementById('m_address').value,
              type: 'GET',
              dataType: 'json',
              success: function(json){
                alert(json['info']);
                if(json['code'] == 200)
                  dataClean();
              },
              error: function(){
                alert('error');
              }
            });
          };
            
            $('#applyDia').modal('hide');
          });

        $("#a_Manage").click(function(event) {
          $.ajax({
           type: "GET",
           url: "./api/getBooked.php?fun=user&username="+getCookie("user"),
            dataType : "json",
           success: function(json){
              for(var count = 1;json["data"][count] != undefined ;count++){
                var num = document.getElementById("searchBookedTable").rows.length;
                var Tr = document.getElementById("searchBookedTable").insertRow(num);
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][count]["date"];
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][count]["rooms"]
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][count]["createTime"]
                Td = Tr.insertCell(Tr.cells.length);
              }   
            },
           error: function() {
               alert("error");
           }
          });
        });
      });

      function getCookie(cname){
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length;i++){
          var c = ca[i];
          while(c.charAt(0)==' ') c = c.substring(1);
          if(c.indexOf(name) != -1) return c.substring(name.length, c.length);
        }
        return "";
      }

      var currentLayer="mHome";
      var currentDiv="home";
      var currentLi="liHome"
      function showLayer(sender, targetDiv, targetLi){
        if ( currentLayer != sender.id ) {  
          document.getElementById(currentDiv).style.display="none";
          document.getElementById(targetDiv).style.display="block";
          document.getElementById(currentLi).className=document.getElementById(currentLi).className.replace("active","");
          document.getElementById(targetLi).className+=" active";
        } 
        currentLayer = sender.id;
        currentDiv = targetDiv;
        currentLi = targetLi;
      }

      var myCalendar;
      function doOnLoad() {
        myCalendar = new dhtmlXCalendarObject({input: "calendar_input", button: "calendar_icon"});
        myCalendar = new dhtmlXCalendarObject(["calendar_input"]);
      }

      window.onload=function(){
        var tfrow = document.getElementById('tfhover').rows.length;
        var tfcol = document.getElementById('tfhover').rows[0].cells.length;
        var tbRow=[];
        var tbCol=[];
        var lastColor,setClick=false;
        for (var i=1;i<tfrow;i++) {
          for(var j=1;j<tfcol;j++){
            tbRow[i]=document.getElementById('tfhover').rows[i];
            tbCol[j]=document.getElementById('tfhover').rows[i].cells[j];
      
            tbCol[j].onmouseover = function(){
              setClick = false;
              lastColor = this.style.background;
              if(lastColor != "rgb(218, 79, 73)" && lastColor != "rgb(30, 197, 229)")
                this.style.backgroundColor = '#FDFF73';
            };
            tbCol[j].onmouseout = function(){
              if(!setClick)
                this.style.backgroundColor = lastColor;
            };
            tbCol[j].onmousedown =function(){
              if(this.style.backgroundColor != "rgb(218, 79, 73)")
                if(this.style.backgroundColor == "rgb(30, 197, 229)"){
                  sBookItem.deleteRoom(this.id);
                  if(this.id % 2 == 0)
                    this.style.backgroundColor = '#f9f9f9';
                  else
                   this.style.backgroundColor = '';
                }
                else{
                  sBookItem.addRoom(this.id);
                  this.style.backgroundColor = '#1ec5e5';
                }
              setClick = true;
            };
          }
        }
      }
    </script>
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
          <a class="brand" href="#home">數字美容學院</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active" id="liHome"><a id="mHome" href="#home" onClick="showLayer(this,'home','liHome');">首頁</a></li>
              <li id="liBook"><a id="mBook" href="#book" onClick="showLayer(this,'book','liBook');">教室預訂</a></li>
              <li id="liContact"><a id="mContact" href="#contact" onClick="showLayer(this,'contact','liContact');">商品列表</a></li>
              <li id="liMember" style="display:none" class="dropdown"><a id="mMember" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown" >會員中心<b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="mMember">
                  <li role="presentation"><a id="a_Manage" role="menuitem" tabindex="-1" href="#" onClick="showLayer(this,'m_Manage','liMember');">訂單查詢</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">會員管理2</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form pull-right" >
              <div id="userDiv" style="display:none">
                <a class="brand" id="user"></a>
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
          <h1>HOME</h1>
          <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
          <p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>
        </div>

      <!-- Example row of columns -->
        <div class="row">
          <div class="span4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn" href="#">View details &raquo;</a></p>
          </div>
          <div class="span4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn" href="#">View details &raquo;</a></p>
          </div>
          <div class="span4" id="about">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn" href="#">View details &raquo;</a></p>
          </div>
        </div>
      </div>

      <div id="book" style="display:none">
        <div class="hero-unit">
          <h1>教室預訂</h1>
          <p>如欲預訂教室，請先選擇日期後點選查詢，並於時間表中點選您欲租借的教室與對應時間，紅色區間為已被預訂時間無法點選，點選後出現藍色區間為您選擇的教室時間，選擇完畢後點選預訂，便完成預訂。</p>
          <!--<p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>-->
        </div>

      <!-- Example row of columns -->
        <div class="row">
          <div class="span12">
            <form class="navbar-form" style="text-align:center">
              <input class="span2" type="text" id="calendar_input" placeholder="2014-01-01">
              <span><img id="calendar_icon" src="./imgs/dhxcalendar_skyblue/calendar.gif" border="0"></span>
              <button type="submit" class="btn" id="searchRoom">查詢</button>
              <button type="submit" class="btn" id="bookRoom">預訂</button>
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

      <div id="contact" style="display:none">
        <div class="hero-unit">
          <h1>CONTACT</h1>
          <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
          <p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>
        </div>

      <!-- Example row of columns -->
        <div class="row">
          
        </div>
      </div>

      <div id="m_Manage" style="display:none">
        <div class="hero-unit">
          <h1>訂單查詢</h1>
          <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
          <p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>
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
                  <td>管理</td>
                </tr>
            </table>
          </div>
        </div>
      </div>


      <hr>

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
                <input name="m_username" type="text" class="normalinput" id="m_username">
                <font color="#FF0000">*</font><br>
                <span class="smalltext">請填入5~12個字元以內的小寫英文字母、數字、以及_ 符號。</span></p>
                <p><strong>使用密碼</strong>：
                <input name="m_passwd" type="password" class="normalinput" id="m_passwd">
                <font color="#FF0000">*</font><br>
                <span class="smalltext">請填入5~10個字元以內的英文字母、數字、以及各種符號組合，</span></p>
                <p><strong>確認密碼</strong>：
                <input name="m_passwdrecheck" type="password" class="normalinput" id="m_passwdrecheck">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext">再輸入一次密碼</span></p>
                <hr size="1" />
                <p class="heading">個人資料</p>
                <p><strong>真實姓名</strong>：
                <input name="m_name" type="text" class="normalinput" id="m_name">
                <font color="#FF0000">*</font> </p>
                <p><strong>性　　別</strong>：
                <input name="m_sex" type="radio" value="女" id="m_sex" checked>女
                <input name="m_sex" type="radio" value="男" >男
                <font color="#FF0000">*</font></p>
                <p><strong>生　　日</strong>：
                <input name="m_birthday" type="text" class="normalinput" id="m_birthday">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext">為西元格式(YYYY-MM-DD)。</span></p>
                <p><strong>電子郵件</strong>：
                <input name="m_email" type="text" class="normalinput" id="m_email">
                <font color="#FF0000">*</font> </p>
                <p class="smalltext">請確定此電子郵件為可使用狀態，以方便未來系統使用，如補寄會員密碼信。</p>
                <p><strong>電　　話</strong>：
                <input name="m_phone" type="text" class="normalinput" id="m_phone"></p>
                <p><strong>住　　址</strong>：
                <input name="m_address" type="text" class="normalinput" id="m_address" size="40"></p>
                <p> <font color="#FF0000">*</font> 表示為必填的欄位</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
              <button type="button" class="btn btn-primary" id="sendApply">送出申請</button>
            </div>
          </div>
        </div>
      </div>

      <footer>
        <p align="center">&copy; 2014 By megshao</p>
      </footer>
    </div> 
  </body>
</html>
