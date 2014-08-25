<?php
    require_once("../connMysql.php");

    $output = array();
    $username = $_POST['username'] ? $_POST['username'] : '';
    $username = addslashes($username);
    $passwd = $_POST['passwd'] ? $_POST['passwd'] : '';
    $passwd = addslashes($passwd);
    $passwd = md5($passwd);
    $name = $_POST['name'] ? $_POST['name'] : '';
    $name = addslashes($name);
    $sex = $_POST['sex'] ? $_POST['sex'] : '女';
    $sex = addslashes($sex);
    $birthday = $_POST['birthday'] ? $_POST['birthday'] : '';
    $birthday = addslashes($birthday);
    $email = $_POST['email'] ? $_POST['email'] : '';
    $email = addslashes($email);
    $phone = $_POST['phone'] ? $_POST['phone'] : '';
    $phone = addslashes($phone);
    $address = $_POST['address'] ? $_POST['address'] : '';
    $address = addslashes($address);
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
        $query_insert .= "'".$passwd."',";
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