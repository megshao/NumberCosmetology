<?php
    require_once("../connMysql.php");

    $output = array();
    $username = $_GET['username'] ? $_GET['username'] : '';
    $passwd = $_GET['passwd'] ? $_GET['passwd'] : '';
    $passwdmd5 = md5($passwd);
    $name = $_GET['name'] ? $_GET['name'] : '';
    $sex = $_GET['sex'] ? $_GET['sex'] : '';
    $birthday = $_GET['birthday'] ? $_GET['birthday'] : '';
    $email = $_GET['email'] ? $_GET['email'] : '';
    $phone = $_GET['phone'] ? $_GET['phone'] : '';
    $address = $_GET['address'] ? $_GET['address'] : '';

    $query_RecLogin = "SELECT * FROM `memberdata` WHERE `m_username`='".$username."'";
    $RecLogin = mysql_query($query_RecLogin)or die(mysql_error());
    $row_RecLogin=mysql_fetch_assoc($RecLogin);

    if(empty($row_RecLogin)){
        $output =  array('data' => false, 'info' => '帳號不存在！','code' => 201 );
        exit(json_encode($output));
    }
    else{
        $save = false;
        $query_insert = "UPDATE `memberdata` SET ";
        if($name!= ''){
            $query_insert .= "`m_name`='".$name."'";
            $save = true;
        }
        if($passwd!= ''){
            if($save)
                $query_insert.=", ";
            $query_insert .= "`m_passwd`='".$passwdmd5."'";
            $save = true;
        }
        if($sex!= ''){
            if($save)
                $query_insert.=", ";
            $query_insert .= "`m_sex`='".$sex."'";
            $save = true;
        }
        if($birthday!= ''){
            if($save)
                $query_insert.=", ";
            $query_insert .= "`m_birthday`='".$birthday."'";
            $save = true;
        }
        if($email!= ''){
            if($save)
                $query_insert.=", ";
            $query_insert .= "`m_email`='".$email."'";
            $save = true; 
        } 
        if($phone!= ''){
            if($save)
                $query_insert.=", ";
            $query_insert .= "`m_phone`='".$phone."'";
            $save = true;
        }
        if($address!= ''){
            if($save)
                $query_insert.=", ";
            $query_insert .= "`m_address`='".$address."'";
            $save = true;
        }
        $query_insert .= " WHERE `m_username` = '".$username."'";  
        mysql_query($query_insert)or die(mysql_error());
        $output = array('data'=>true,'info' => '修改成功！','code' => 200);
        exit(json_encode($output));
    }

?>