
<?php
    require_once("../connMysql.php");

    $output = array();
    $name = $_POST['name'] ? $_POST['name'] : '';
    $name = addslashes($name);
    $price = $_POST['price'] ? $_POST['price'] : 0;
    $price = addslashes($price);
    $count = $_POST['count'] ? $_POST['count'] : 0;
    $count = addslashes($count);
    $content = $_POST['content'] ? $_POST['content'] : '';
    $content = addslashes($content);

    $uploaddir="../upload/"; 
    $tmpfile=$_FILES["uploadfile"]["tmp_name"]; 
    $file_arr = explode(".", $_FILES["uploadfile"]["name"]);
    $file_type = $file_arr[count($file_arr)-1];
    $filename =  md5(uniqid(rand()));
    $filename = $filename.".".$file_type;
    if(move_uploaded_file($tmpfile,$uploaddir.$filename)){
        $query_insert = "INSERT INTO `sellItem` (`s_name` ,`s_price`  ,`s_count` ,`s_content`,`s_pictureName`) VALUES (";
        $query_insert .= "'".$name."',";
        $query_insert .= "'".$price."',";
        $query_insert .= "'".$count."',";
        $query_insert .= "'".$content."',";  
        $query_insert .= "'".$filename."')";  
        $checkInsert = mysql_query($query_insert)or die(mysql_error());
        if($checkInsert)
            $output = array('stat'=>true,'info' => '商品建立成功！');
        else
            $output = array('stat'=>false,'info' => '商品建立失敗！');
        exit(json_encode($output));
    }
    else{
        $output = array('stat'=>false,'info' => 'upload failed！');
        exit(json_encode($output));
    }
?>