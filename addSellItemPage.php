<!-- 新增商品頁面 -->
<!-- Main hero unit for a primary marketing message or call to action -->
      <div id="addSellItemPage">
        <div class="hero-unit">
          <h1>新增商品</h1>
          <p>管理員輸入商品內容以及上傳商品圖片後新增商品至列表</p>
          <p><a href="#" class="btn btn-primary btn-large">Learn more &raquo;</a></p>
        </div>

      <!-- Example row of columns -->
        <div class="row">
          <div class="span12">
              <form class="navbar-form" action="" method="post" enctype="multipart/form-data">
                商品名稱：<input class="span2" type="text" placeholder="" id="u_name" name="name"><br>
                商品價錢：<input class="span2" type="number" placeholder="" id="u_price" name="price"><br>
                商品數量：<input class="span2" type="number" placeholder="" id="u_count" name="count"><br>
                商品內容：<input class="span2" type="text" placeholder="" id="u_content" name="content"><br>
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000"> 
                商品圖片：<input class="span2" type="file"  id="uploadfile" name="uploadfile"><br>
                <button type="submit" class="btn" id="addItem" onclick="ajaxFileUpload(); return false;">送出</button>
              </form>
          </div>
        </div>
      </div>