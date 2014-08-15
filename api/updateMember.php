<?php
    require_once("../connMysql.php");

    $output = array();
    $username = $_POST['username'] ? $_POST['username'] : '';
    $passwd = $_POST['passwd'] ? $_POST['passwd'] : '';
    $passwdmd5 = md5($passwd);
    $name = $_POST['name'] ? $_POST['name'] : '';
    $sex = $_POST['sex'] ? $_POST['sex'] : '';
    $birthday = $_POST['birthday'] ? $_POST['birthday'] : '';
    $email = $_POST['email'] ? $_POST['email'] : '';
    $phone = $_POST['phone'] ? $_POST['phone'] : '';
    $address = $_POST['address'] ? $_POST['address'] : '';

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