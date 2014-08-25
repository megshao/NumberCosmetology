<?php
    require_once("../connMysql.php");
    $output = array();
    $fun = $_POST['fun'] ? $_POST['fun'] : '';
    $user = $_POST['user'] ? $_POST['user'] : '';
    $user = addslashes($user);
    if(empty($fun) || empty($user)){
        $output = array('stat' => false,'info' => $user);
        exit(json_encode($output));
    }
    $query_Search = "SELECT `m_point` FROM `memberdata` WHERE `m_username`='".$user."'";
    $Search = mysql_query($query_Search)or die(mysql_error());
    $row_Search=mysql_fetch_assoc($Search);
    switch ($fun) {
        case 'get':
            $output = array('stat' => true, 'point' => $row_Search['m_point']+0);
            exit(json_encode($output));
            break;
        case 'add':
            $o_user = $_POST['o_user'] ? $_POST['o_user'] : '';
            $o_user = addslashes($o_user);
            $addNum = $_POST['num'] ? $_POST['num'] : '';
            $type = $_POST['type'] ? $_POST['type'] : '';
            $type = addslashes($type);
            $pointNum = $row_Search['m_point'] + $addNum;
            $query_Add = "UPDATE `memberdata` SET `m_point` = ".$pointNum." WHERE `m_username` ='".$user."'";
            $Add = mysql_query($query_Add) or die(mysql_error());
            if($Add){
                $output=array('stat' => true, 'point' => $pointNum);
                file_get_contents("http://localhost/~Yu-Shao-Cheng/NumberCosmetology/api/pointEvent.php?fun=add&user=".$user."&o_user=".$o_user."&num=".$addNum."&type=".$type);
            }
            else
                $output=array('stat' => false);
            exit(json_encode($output));
            break;    
        case 'use':
            $useNum = $_POST['num'] ? $_POST['num'] : '';
            $pointNum = $row_Search['m_point'] - $useNum;
            if($pointNum >= 0){
                $query_Use = "UPDATE `memberdata` SET `m_point` = ".$pointNum." WHERE `m_username` ='".$user."'";
                $Use = mysql_query($query_Use) or die(mysql_error());
                if($Use){
                    $output=array('stat' => true, 'point' => $pointNum);
                    file_get_contents("http://localhost/~Yu-Shao-Cheng/NumberCosmetology/api/pointEvent.php?fun=use&user=".$user."&o_user=".$user."&num=".$useNum);
                }
                else
                    $output=array('stat' => false, 'info' => 'Update失敗！');
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