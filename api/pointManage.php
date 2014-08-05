<?php
    require_once("../connMysql.php");
    $output = array();
    $fun = $_GET['fun'] ? $_GET['fun'] : '';
    $user = $_GET['user'] ? $_GET['user'] : '';
    if(empty($fun) || empty($user)){
        $output = array('stat' => false);
        exit(json_encode($output));
    }
    $query_Search = "SELECT `m_point` FROM `memberdata` WHERE `m_username`='".$user."'";
    $Search = mysql_query($query_Search)or die(mysql_error());
    $row_Search=mysql_fetch_assoc($Search);
    switch ($fun) {
        case 'get':
            $output = array('stat' => true, 'point' => $row_Search['m_point']);
            exit(json_encode($output));
            break;
        case 'add':
            $addNum = $_GET['num'] ? $_GET['num'] : '';
            $pointNum = $row_Search['m_point'] + $addNum;
            $query_Add = "UPDATE `memberdata` SET `m_point` = ".$pointNum." WHERE `m_username` ='".$user."'";
            $Add = mysql_query($query_Add) or die(mysql_error());
            if($Add)
                $output=array('stat' => true, 'point' => $pointNum);
            else
                $output=array('stat' => false);
            exit(json_encode($output));
            break;    
        case 'use':
            $useNum = $_GET['num'] ? $_GET['num'] : '';
            $pointNum = $row_Search['m_point'] - $useNum;
            if($pointNum >= 0){
                $query_Use = "UPDATE `memberdata` SET `m_point` = ".$pointNum." WHERE `m_username` ='".$user."'";
                $Use = mysql_query($query_Use) or die(mysql_error());
                if($Use)
                    $output=array('stat' => true, 'point' => $pointNum);
                else
                    $output=array('stat' => false);
                exit(json_encode($output));
            }
            else{
                $output = array('stat' => false, 'info' => '點數不足！');
                exit(json_encode($output));
            }
            break;
        default:
            # code...
            break;
    }
?>