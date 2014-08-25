<?php 
    require_once("../connMysql.php");
    $output = array();
    $user = $_GET['user'] ? $_GET['user'] : '';
    $user = addslashes($user);
    $date = $_GET['date'] ? $_GET['date'] : '';
    $date = addslashes($date);
    $rooms = $_GET['rooms'] ? $_GET['rooms'] : '';
    //$rooms = addslashes($rooms);

    if(!empty($date) && !empty($rooms) && !empty($user)){
        $query_search = "SELECT b_ID FROM `bookRoom` WHERE `b_Date` = '".$date."' AND `b_Rooms`= '".$rooms."' AND (SELECT b_UserID FROM `memberdata` WHERE `m_username` = '".$user."')";
        $Search = mysql_query($query_search)or die(mysql_error());
        $row_Search=mysql_fetch_assoc($Search);

        if(!empty($row_Search)){
            $query_delete = "DELETE FROM `bookRoom` WHERE `b_ID` = ".$row_Search['b_ID'];
            $Delete = mysql_query($query_delete)or die(mysql_error());
            if($Delete){
                $saveRooms = explode(';',$rooms);
                date_default_timezone_set('Asia/Taipei');
                $saveDate = strtotime($date);
                if($saveDate > strtotime("+3 days")){
                    $postData = array('fun' => 'add','user' => $user,'o_user' => $user, 'num' =>sizeof($saveRooms),'type' => 3);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://localhost/~Yu-Shao-Cheng/NumberCosmetology/api/pointManage.php");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    //curl_setopt($ch, CURLOPT_URL, "http://localhost/~Yu-Shao-Cheng/NumberCosmetology/api/pointManage.php?fun=add&user=".$user."&o_user=".$user."&num=".sizeof($saveRooms)."&type=3");
                    $result=curl_exec($ch);
                    curl_close($ch);
                    exit($result);
                }
                else{
                    $postData = array('fun' => 'get','user' => $user);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://localhost/~Yu-Shao-Cheng/NumberCosmetology/api/pointManage.php");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    //curl_setopt($ch, CURLOPT_URL, "http://localhost/~Yu-Shao-Cheng/NumberCosmetology/api/pointManage.php?fun=get&user=".$user);
                    $result=curl_exec($ch);
                    curl_close($ch);
                    exit($result);
                }
            }
            else{
                $output = array('stat'=>false);
                exit(json_encode($output));
            }
        }
        else{
            $output = array('stat'=>false);
            exit(json_encode($output));
        }
    }
    else{
        $output = array('stat' => false );
        exit(json_encode($output));
    }
?>