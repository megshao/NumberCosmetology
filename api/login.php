<?php
    require_once("../connMysql.php");

    $output = array();
    $username = $_POST['username'] ? $_POST['username'] : '';
    $username = addslashes($username);
    $passwd = $_POST['passwd'] ? $_POST['passwd'] : '';
    $passwd = md5($passwd);

    $query_RecLogin = "SELECT * FROM `memberdata` WHERE `m_username`='".$username."'";
    $RecLogin = mysql_query($query_RecLogin)or die(mysql_error());
    $row_RecLogin=mysql_fetch_assoc($RecLogin);

    if(empty($username)){
        $output = array('data'=>false, 'info'=>'username is empty', 'code'=>202);
        exit(json_encode($output));
    }
    else if(empty($passwd)){
        $output = array('data'=>false, 'info'=>'passwd is empty', 'code'=>203);
        exit(json_encode($output));
    }

    if($passwd == $row_RecLogin["m_passwd"]){
        $output = array('data'=>true, 'info'=>'success', 'code'=>200, 'userType' => $row_RecLogin["m_level"]);
        exit(json_encode($output));
    }
    else{
        $output = array('data'=>false, 'info'=>'passwd is not right ', 'code'=>201);
        exit(json_encode($output));
    }
?>