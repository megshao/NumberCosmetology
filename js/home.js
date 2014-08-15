var sBookItem;
      $(document).ready(function(){
        if(getCookie("stat") != "success" ){
          var username;
          $("#login").click(function(){  
            var username=$("#l_username").val();
            var password=$("#password").val();
            $.ajax({
              async: false,
              type: "POST",
              url: "./api/login.php?username="+username+"&passwd="+password,
              dataType : "json",
              data: {username:username,passwd:password},
              success: function(json){    
                if(json["info"]=="success"){
                  document.cookie = "stat=success; " ; 
                  document.cookie = "user="+username+"; ";
                  document.cookie = "userType="+json["userType"]+"; ";
                  window.location.reload(true);
                }
                else{
                  alert("帳號或密碼錯誤！");
                  document.getElementById('l_username').value="";
                  document.getElementById('password').value="";
                }
              },
              error: function() {
                 alert("login error");
              }
            });
            $.ajax({
                    async: false,
                    url: './api/pointManage.php?fun=get&user='+username,
                    type: 'GET',
                    dataType: 'json',
                    success: function(json){
                      if(json["stat"] == true)
                        document.cookie = "point="+json["point"]+"; ";
                    },
                    error: function(error){
                      alert("point show error");
                    }
                  });
            return false;
          });
        }
        else{
          document.getElementById('userDiv').style.display='';
          document.getElementById('loginDiv').style.display='none';
          document.getElementById('user').innerHTML=getCookie("user");
          document.getElementById('point').innerHTML=getCookie("point")+'點';
          document.getElementById('liMember').style.display="block";
          $("#logout").click(function(event) {
            document.cookie = "stat=;";
            document.cookie = "user=;";
            document.cookie = "point=;";
            document.cookie = "userType=;";
            document.getElementById('userDiv').style.display='none';
            document.getElementById('loginDiv').style.display='';
            document.getElementById('liMember').style.display='none';
            window.location.reload(true);
            return false;
          });
        }

        $("#searchRoom").click(function(event) {
          var date = $("#calendar_input").val();
          iUser = getCookie("user");
          if(date != ""){
            sBookItem = new bookItem(date,iUser);
            $.ajax({
              url: './api/getBooked.php?fun=date&date='+date,
              type: 'GET',
              dataType: 'json',
              success: function(json){
                for(var i = 1; i < 8 ; i++){
                  for(var j = 1; j < 11 ; j++){
                    if(j % 2 == 0)
                        document.getElementById(i*100 + j).style.background="#f9f9f9";
                      else
                        document.getElementById(i*100 + j).style.background="";
                  }
                }
                if(json["stat"]==true){
                  if(json["bookedRooms"]!=''){
                      var saveID = json["bookedRooms"].split(";");
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
          }
          else{
            alert("請輸入日期！");
          }
          return false;
        });

        $("#bookRoom").click(function(event) { 
          sBookItem.rooms = sBookItem.rooms.substring(0,sBookItem.rooms.lastIndexOf(";"));
          sBookItem.user = getCookie("user");
          var userCheck = confirm("您所預訂的教室時間需花費"+sBookItem.numOfItem+"點，確定送出?");
          if(userCheck)
          if(sBookItem.user != ""){
              $.ajax({//送出訂單前確認點數足夠
                      url: './api/pointManage.php?fun=use&user='+getCookie("user")+'&num='+sBookItem.numOfItem,
                      type: 'GET',
                      dataType: 'json',
                     success: function(json){
                       if(json["stat"] == true){
                          document.cookie = "point="+json["point"]+"; ";
                          $.ajax({
                            url: './api/bookRooms.php?date='+sBookItem.date+'&rooms='+sBookItem.rooms+'&user='+sBookItem.user,
                            type: 'GET',
                            dataType: 'json',
                            success: function(json){
                            if(json["stat"]==true){
                              document.getElementById("searchRoom").click();
                              document.getElementById("point").innerHTML=getCookie("point")+'點';
                              alert("預定成功！請至訂單查詢確認");
                            }
                            else
                            alert("預訂失敗！");
                            },
                            error: function(){
                              alert("error");
                            }
                          });
                        }
                       else 
                        alert(json["info"]);
                     },
                      error: function(){
                        alert("error");
                     }
              });
          }
          else{
            alert("請先登入會員！");
          }
          return false;
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
            return false;
          });

        $("#sendUpdate").click(function(event) {
          var userCheck = confirm("確定送出修改?");
          if(userCheck){
            if(document.getElementById('up_oldpasswd').value != ''){
              $.ajax({
                url: "./api/login.php?username="+getCookie("user")+"&passwd="+document.getElementById('up_oldpasswd').value,
                type: 'GET',
                dataType: 'json',
                success: function(json){
                  if(json["data"]){
                    if(document.getElementById('up_newpasswd').value == document.getElementById('up_newpasswdrecheck').value){
                    var sex ='';
                    if(document.getElementById('up_sex_f').checked)
                      sex = '女';
                    if(document.getElementById('up_sex_m').checked)
                      sex = '男';        
                    $.ajax({
                      url: './api/updateMember.php?username='+getCookie("user")+'&passwd='+document.getElementById('up_newpasswd').value
                            +'&name='+document.getElementById('up_name').value+'&sex='+sex+'&birthday='+document.getElementById('up_birthday').value
                            +'&email='+document.getElementById('up_email').value+'&phone='+document.getElementById('up_phone').value+'&address='+document.getElementById('up_address').value,
                      type: 'GET',
                      dataType: 'json',
                      success: function(json){
                        alert(json['info']);
                        alert("修改密碼需重新登入！");
                        document.getElementById("logout").click();
                      },
                      error: function(){
                        alert('error');
                      }
                    });
                  }
                  else{
                    alert("確認新密碼錯誤");
                  }
                }
                  else{
                    alert("密碼錯誤");
                  }
                },
                error: function(){
                  alert("check error");
                }
              });
              
            }
            else{
              var sex ='';
              if(document.getElementById('up_sex_f').checked)
                sex = '女';
              if(document.getElementById('up_sex_m').checked)
                sex = '男';        
              $.ajax({
                url: './api/updateMember.php?username='+getCookie("user")+'&passwd='
                      +'&name='+document.getElementById('up_name').value+'&sex='+sex+'&birthday='+document.getElementById('up_birthday').value
                      +'&email='+document.getElementById('up_email').value+'&phone='+document.getElementById('up_phone').value+'&address='+document.getElementById('up_address').value,
                type: 'GET',
                dataType: 'json',
                success: function(json){
                  alert(json['info']);
                },
                error: function(){
                  alert('error');
                }
              });
            }
            
          }
            return false;
          });

        $("#addPointBtn").click(function(event) {
          $.ajax({
            url: './api/pointManage.php?fun=add&user='+$("#a_username").val()+'&o_user='+getCookie("user")+'&num='+$("#numPoint").val()+'&type=2',
            type: 'GET',
            dataType: 'json',
            success: function(json){
              alert("帳號:"+$("#a_username").val()+"現在有"+json["point"]+"點");
            },
            error: function(){
              alert("error");
            }
          });
        });

        $("#a_Manage").click(function(event) {
          tableClean("searchBookedTable");
          $.ajax({
           type: "GET",
           url: "./api/getBooked.php?fun=user&username="+getCookie("user"),
            dataType : "json",
           success: function(json){
              for(var count = 1;json["data"][count] != undefined ;count++){
                var num = document.getElementById("searchBookedTable").rows.length;
                var Tr = document.getElementById("searchBookedTable").insertRow(num);
                Tr.id = 'tr'+count;
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][count]["date"];
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][count]["rooms"];
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][count]["createTime"];
                Td = Tr.insertCell(Tr.cells.length);
                if(compareDate(json["data"][count]["date"]))
                  Td.innerHTML = "已結束";
                else
                  Td.innerHTML = "已預訂";
                Td = Tr.insertCell(Tr.cells.length);
                if(!compareDate(json["data"][count]["date"]))
                  Td.innerHTML="<a onClick=deleteBtn('"+getCookie("user")+"','"+json["data"][count]["date"]+"','"+json["data"][count]["rooms"]+"','"+Tr.id+"');><img src='img/delete.png' width='24' height='24'></a>";
              }   
            },
           error: function() {
               alert("Manage error");
           }
          });
        });

        $("#a_showPoint").click(function(event) {
          tableClean("searchPointTable");
          $.ajax({
           type: "GET",
           url: "./api/pointEvent.php?fun=get&user="+getCookie("user"),
            dataType : "json",
           success: function(json){
              for(var p_count = 1 ;json["data"][p_count] != undefined ;p_count++){
                var num = document.getElementById("searchPointTable").rows.length;
                var Tr = document.getElementById("searchPointTable").insertRow(num);
                Tr.id = 'tr'+p_count;
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][p_count]["user"];
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][p_count]["operateBy"];
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][p_count]["value"]+"點";
                Td = Tr.insertCell(Tr.cells.length);
                switch(json["data"][p_count]["type"]){
                  case '1':
                    Td.innerHTML = "使用";
                    break;
                  case '2':
                    Td.innerHTML = "儲值";
                    break;
                  case '3':
                    Td.innerHTML = "回補";
                    break;
                }
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][p_count]["time"];
                Td = Tr.insertCell(Tr.cells.length);
                Td.innerHTML= json["data"][p_count]["remark"];
              }   
            },
           error: function() {
               alert("Point error");
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

      function tableClean(inputTable){
        var rNum = document.getElementById(inputTable).rows.length;
        while(rNum > 1){
          document.getElementById(inputTable).deleteRow(-1);
          rNum--;
        }
      }

      function deleteBtn(iUser,iDate,iRooms,iTrID){
        var userCheckDelete = confirm("預訂時間三天內，如取消預訂將不會回補點數，確認刪除?");
        if(userCheckDelete)
        $.ajax({
          url: './api/deleteRooms.php?user='+iUser+'&date='+iDate+'&rooms='+iRooms,
          type: 'GET',
          dataType: 'json',
          success: function(json){
            if(json["stat"] == true){
              alert("刪除成功！");
              document.getElementById(iTrID).style.display='none';
              document.cookie = "point="+json["point"]+"; ";
              document.getElementById("point").innerHTML=getCookie("point")+'點';
            }
            else
              alert("刪除失敗！");
          },
          error: function(){
            alert("error");
          }
        });
        
      }

      function compareDate(saveDate){
        var tempDate = saveDate.split("-");
        var dt = new Date();
        var curDate = new Array(dt.getFullYear(),dt.getMonth()+1,dt.getDate());
        for(var i = 0 ; i < 3; i++){
          if(curDate[i] > tempDate[i])
            return true;
        }
        return false;
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
              if(!compareDate(sBookItem.date)){
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
            }
            else{
              alert("預訂日期必須為今天以後！");
            }
            };
          }
        }
      }