<div class="hero-unit">
          <h1>會員資料修改</h1>
          <p></p>
        </div>

      <!-- Example row of columns -->
        <div class="row">
          <div class="span12">
                <p class="heading">帳號資料</p>
                <p><strong>使用帳號</strong>：
                <?php echo $_COOKIE["user"]; ?></p>
                <p><strong>舊密碼</strong>：  
                <input name="up_passwd" type="password" class="form-control" id="up_oldpasswd">
                <br>
                <span class="smalltext">如果需修改密碼，請先填入原有舊密碼進行驗證，</span></p>
                <p><strong>新密碼</strong>：  
                <input name="up_passwd" type="password" class="form-control" id="up_newpasswd">
                <br>
                <span class="smalltext">請填入5~10個字元以內的英文字母、數字、以及各種符號組合，</span></p>
                <p><strong>確認新密碼</strong>：
                <input name="up_passwdrecheck" type="password" class="form-control" id="up_newpasswdrecheck">
                <br>
                <span class="smalltext">再輸入一次新密碼</span></p>
                <hr size="1" />
                <p class="heading">個人資料</p>
                <p><strong>真實姓名</strong>：
                <input name="up_name" type="text" class="form-control" id="up_name">
                </p>
                <p><strong>性　　別</strong>：
                <input name="up_sex" type="radio" value="女" id="up_sex_f" >女
                <input name="up_sex" type="radio" value="男" id="up_sex_m" >男
                </p>
                <p><strong>生　　日</strong>：
                <input name="up_birthday" type="text" class="form-control" id="up_birthday">
                <br>
                <span class="smalltext">為西元格式(YYYY-MM-DD)。</span></p>
                <p><strong>電子郵件</strong>：
                <input name="up_email" type="text" class="form-control" id="up_email">
                </p>
                <p class="smalltext">請確定此電子郵件為可使用狀態，以方便未來系統使用，如補寄會員密碼信。</p>
                <p><strong>電　　話</strong>：
                <input name="up_phone" type="text" class="form-control" id="up_phone"></p>
                <p><strong>住　　址</strong>：
                <input name="up_address" type="text" class="form-control" id="up_address" size="40"></p>
                
                <button type="button" class="btn btn-primary" id="sendUpdate">送出修改</button>
          </div>
        </div>