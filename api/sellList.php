<?php
    require_once("../connMysql.php");

    $output = array();
    //$username = $_POST['username'] ? $_POST['username'] : '';
    //$username = addslashes($username);
    //$passwd = $_POST['passwd'] ? $_POST['passwd'] : '';
    //$passwd = md5($passwd);

    $query_sellList = "SELECT * FROM `sellItem`";
    $sellList = mysql_query($query_sellList)or die(mysql_error());
    $row_sellList=mysql_fetch_assoc($sellList);
    $saveArray = array();
    $count = 1;
    if(!empty($row_sellList)){
        do{
            $saveArray[$count] = array("name" => $row_sellList["s_name"], "count" => $row_sellList["s_count"], "content" => $row_sellList["s_content"], "picturename" => $row_sellList["s_pictureName"]);
            $count++;
        }while ( $row_sellList = mysql_fetch_assoc($sellList));
    }

    $output = array('stat' => true, 'data' => $saveArray);

    //$output = array("stat" => true, "name" => $row_sellList["s_name"], "count" => $row_sellList["s_count"], "content" => $row_sellList["s_content"], "picturename" => $row_sellList["s_pictureName"]);
    exit(json_encode($output));
?>