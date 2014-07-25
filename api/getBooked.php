<?php 
    require_once("../connMysql.php");
    $output = array();
    $saveRooms = '';
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
?>