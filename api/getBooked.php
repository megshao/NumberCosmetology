<?php 
    require_once("../connMysql.php");
    $output = array();
    $saveRooms = '';
    $fun = $_GET['fun'] ? $_GET['fun'] : '';
    if(!empty($fun)){
        switch ($fun) {
            case 'date':
                $date = $_GET['date'] ? $_GET['date'] : '';
                if(!empty($date)){
                    $query_search = "SELECT * FROM bookRoom WHERE b_Date='".$date."'";
                    $Search = mysql_query($query_search)or die(mysql_error());
                    $row_Search=mysql_fetch_assoc($Search);

                    $count = 1;
                    if(!empty($row_Search)){
                     do{
                        if(!empty($saveRooms))
                            $saveRooms.=';';
                        $saveRooms.=$row_Search['b_Rooms'];
                        $count++;
                        }while ( $row_Search = mysql_fetch_assoc($Search));
                    }
                $output = array('stat'=>true, 'bookedRooms'=>$saveRooms);
                exit(json_encode($output));
                }
                else{
                    $output = array('stat' => false );
                    exit(json_encode($output));
                }
                break;
            case 'user':
                $user = $_GET['username'] ? $_GET['username'] : '';
                if (!empty($user)) {
                    $query_search = "SELECT * FROM `bookRoom` WHERE `b_UserID` = (SELECT m_id FROM `memberdata` WHERE m_username = '".$user."') ORDER BY b_Date";
                    $Search = mysql_query($query_search) or die(mysql_error());
                    $row_Search = mysql_fetch_assoc($Search);

                    $saveArray = array();
                    $count = 1;
                    if(!empty($row_Search)){
                        do{
                            $saveArray[$count] = array('date' => $row_Search['b_Date'], 'rooms' => $row_Search['b_Rooms'], 'createTime' => $row_Search['b_Time']);
                            $count++;
                        }while($row_Search = mysql_fetch_assoc($Search));
                    }
                    $output = array('stat' => true, 'data' => $saveArray);
                    exit(json_encode($output));
                }
                else{
                    $output = array('stat' => false);
                    exit(json_encode($output));
                }
                break;
            default:
                # code...
                break;
        }
    }
    else{
        $output = array('stat' => false );
        exit(json_encode($output));
    }
?>