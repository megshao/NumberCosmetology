<?php
    require_once("../connMysql.php");

    $output = array();
    $username = $_GET['username'] ? $_GET['username'] : '';
    $passwd = $_GET['passwd'] ? $_GET['passwd'] : '';
    $passwd = md5($passwd);
    $name = $_GET['name'] ? $_GET['name'] : '';
    $sex = $_GET['sex'] ? $_GET['sex'] : '女';
    $birthday = $_GET['birthday'] ? $_GET['birthday'] : '';
    $email = $_GET['email'] ? $_GET['email'] : '';
    $phone = $_GET['phone'] ? $_GET['phone'] : '';
    $address = $_GET['address'] ? $_GET['address'] : '';

    $query_RecLogin = "SELECT * FROM `memberdata` WHERE `m_username`='".$username."'";
    $RecLogin = mysql_query($query_RecLogin)or die(mysql_error());
    $row_RecLogin=mysql_fetch_assoc($RecLogin);

    if(!empty($row_RecLogin)){
        $output =  array('data' => false, 'info' => '帳號重複！','code' => 201 );
        exit(json_encode($output));
    }
    else{
        $query_insert = "INSERT INTO `memberdata` (`m_name` ,`m_username` ,`m_passwd` ,`m_sex` ,`m_birthday` ,`m_email`,`m_phone`,`m_address`) VALUES (";
        $query_insert .= "'".$name."',";
        $query_insert .= "'".$username."',";
        $query_insert .= "'".md5($passwd)."',";
        $query_insert .= "'".$sex."',";
        $query_insert .= "'".$birthday."',";
        $query_insert .= "'".$email."',";  
        $query_insert .= "'".$phone."',";
        $query_insert .= "'".$address."')";  
        mysql_query($query_insert)or die(mysql_error());
        $output = array('data'=>true,'info' => '帳號建立成功！','code' => 200);
        exit(json_encode($output));
    }

?>