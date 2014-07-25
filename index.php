
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
    <script src="js/dhtmlxcalendar.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script type="text/javascript">
      var temp = new Array();
      $(document).ready(function(){
        if(getCookie("stat") != "success"){
          $("#login").click(function(){  
            var username=$("#username").val();
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
                  document.getElementById('username').value="";
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
          $("#logout").click(function(event) {
            document.cookie = "stat=;";
            document.cookie = "user=;";
            document.getElementById('userDiv').style.display='none';
            document.getElementById('loginDiv').style.display='';
          });
        }

        $("#searchRoom").click(function(event) {
          var date = $("#calendar_input").val();
          $.ajax({
            url: './api/getBooked.php?date='+date,
            type: 'GET',
            dataType: 'json',
            success: function(json){
              /*alert(temp.length);
              if(temp.length!=0){
                alert("QQQ");
                for(var i = 0 ; i < temp.length ; i++){
                    document.getElementById(temp[i]).style.background="#FDFF73";
                  }
              }*/
              if(json["stat"]==true){
                alert(json["bookedRooms"]);
                temp = json["bookedRooms"].split(";");
                if(json["bookedRooms"]!='')
                  for(var i = 0 ; i < temp.length ; i++){
                    document.getElementById(temp[i]).style.background="#da4f49";
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
          document.getElementById(currentLi).className="";
          document.getElementById(targetLi).className="active";
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
        var lastColor;
        for (var i=1;i<tfrow;i++) {
          for(var j=0;j<tfcol;j++){
            tbRow[i]=document.getElementById('tfhover').rows[i];
            tbCol[j]=document.getElementById('tfhover').rows[i].cells[j];
      
            tbCol[j].onmouseover = function(){
              lastColor = this.style.backgroundColor;
              if(lastColor != "rgb(218, 79, 73)")
                this.style.backgroundColor = '#FDFF73';
            };
            tbCol[j].onmouseout = function(){
                this.style.backgroundColor = lastColor;
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
            </ul>
            <form class="navbar-form pull-right" >
              <div id="userDiv" style="display:none">
                <a class="brand" id="user"></a>
                <button type="submit" class="btn" id="logout">登出</button>
              </div>
              <div id="loginDiv">
                <input class="span2" type="text" placeholder="帳號" id="username">
                <input class="span2" type="password" placeholder="密碼" id="password">
                <button type="submit" class="btn" id="login">登入</button>
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
          <h1>BOOK</h1>
          <p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
          <p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>
        </div>

      <!-- Example row of columns -->
        <div class="row">
          <div class="span12">
            <form class="navbar-form" style="text-align:center">
              <input class="span2" type="text" id="calendar_input" placeholder="2014-01-01">
              <span><img id="calendar_icon" src="./imgs/dhxcalendar_skyblue/calendar.gif" border="0"></span>
              <button type="submit" class="btn" id="searchRoom">查詢</button>
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

      <hr>

      <footer>
        <p>&copy; 2014 By megshao</p>
      </footer>
    </div> 
  </body>
</html>
