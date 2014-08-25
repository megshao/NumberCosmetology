<?php
    require_once("../connMysql.php");
    $output = array();
    $fun = $_GET['fun'] ? $_GET['fun'] : '';
    $user = $_GET['user'] ? $_GET['user'] : '';
    $user = addslashes($user);
    if(empty($fun) || empty($user)){
        $output = array('stat' => false);
        exit(json_encode($output));
    }
    $query_Search = "SELECT `m_ID`,`m_name` FROM `memberdata` WHERE `m_username`='".$user."'";
    $Search = mysql_query($query_Search)or die(mysql_error());
    $row_Search=mysql_fetch_assoc($Search);
    $userID = $row_Search['m_ID'];
    $userName = $row_Search['m_name'];
    switch ($fun) {
        case 'get':
            $query_pSearch = "SELECT po.*,b.m_name AS m_name_U,c.m_name AS m_name_O FROM pointOperation AS po,memberdata AS b, memberdata AS c WHERE po.p_userID = b.m_ID AND po.p_operateBy = c.m_ID AND po.p_userID =".$userID;
            $pSearch = mysql_query($query_pSearch)or die(mysql_error());
            $row_pSearch=mysql_fetch_assoc($pSearch);

            $saveArray = array();
            $count = 1;
            if(!empty($row_pSearch)){
                do{
                    $saveArray[$count] = array('user' => $row_pSearch['m_name_U'], 'operateBy' => $row_pSearch['m_name_O'], 'value' => $row_pSearch['changeValue'],'type' => $row_pSearch['eventTypeID'],'time'=>$row_pSearch['eventTime'],'remark'=>$row_pSearch['remark']);
                    $count++;
                }while($row_pSearch = mysql_fetch_assoc($pSearch));
            }
            $output = array('stat' => true, 'data' => $saveArray);
            exit(json_encode($output));
            break;
        case 'add':
            $operateUser = $_GET['o_user'] ? $_GET['o_user'] : '';
            $operateUser = addslashes($operateUser);
            $num = $_GET['num'] ? $_GET['num'] :'';
            $num = addslashes($num);
            $remark='';
            $addtype = $_GET['type'] ? $_GET['type'] :'';
            $addtype = addslashes($addtype);
            $query_oSearch = "SELECT `m_ID`,`m_name` FROM `memberdata` WHERE `m_username`='".$operateUser."'";
            $oSearch = mysql_query($query_oSearch)or die(mysql_error());
            $row_oSearch=mysql_fetch_assoc($oSearch);
            $operateUserID = $row_oSearch['m_ID'];
            $operateUserID = addslashes($operateUserID);
            $query_Use = "INSERT INTO `pointOperation` (`p_userID`, `changeValue`, `p_operateBy`, `eventTypeID`, `remark`) VALUES ('".$userID."', '".$num."', '".$operateUserID."', '".$addtype."', '".$remark."')";
            $Use = mysql_query($query_Use) or die(mysql_error());
            if($Use)
                $output=array('stat' => true);
            else
                $output=array('stat' => false);
            exit(json_encode($output));
            break;    
        case 'use':
            $operateUser = $_GET['o_user'] ? $_GET['o_user'] : '';
            $operateUser = addslashes($operateUser);
            $num = $_GET['num'] ? $_GET['num'] :'';
            $num = addslashes($num);
            $remark='';
            $query_oSearch = "SELECT `m_ID`,`m_name` FROM `memberdata` WHERE `m_username`='".$operateUser."'";
            $oSearch = mysql_query($query_oSearch)or die(mysql_error());
            $row_oSearch=mysql_fetch_assoc($oSearch);
            $operateUserID = $row_oSearch['m_ID'];
            $operateUserID = addslashes($operateUserID);
            $query_Use = "INSERT INTO `pointOperation` (`p_userID`, `changeValue`, `p_operateBy`, `eventTypeID`, `remark`) VALUES ('".$userID."', '".$num."', '".$operateUserID."', '1', '".$remark."')";
            $Use = mysql_query($query_Use) or die(mysql_error());
            if($Use)
                $output=array('stat' => true);
            else
                $output=array('stat' => false,'info' => '插入資料失敗');
            exit(json_encode($output));
            break;
        default:
            # code...
            break;
    }
?>