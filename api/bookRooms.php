<?php 
    require_once("../connMysql.php");
    $output = array();
    $saveRooms = '';
    $date = $_GET['date'] ? $_GET['date'] : '';
    $rooms = $_GET['rooms'] ? $_GET['rooms'] : '';
    $user = $_GET['user'] ? $_GET['user'] : '';

    if(!empty($date) && !empty($rooms) && !empty($user)){
        $query_search = "SELECT m_id FROM memberdata WHERE m_username='".$user."'";
        $Search = mysql_query($query_search)or die(mysql_error());
        $row_Search=mysql_fetch_assoc($Search);

        $query_book = "INSERT INTO `bookRoom` (`b_Date`,`b_Rooms`,`b_UserID`) VALUES ( '".$date."','".$rooms."',".$row_Search['m_id'].");";
        $Book = mysql_query($query_book)or die(mysql_error());

        $output = array('stat'=>true);
        exit(json_encode($output));
    }
    else{
        $output = array('stat' => false );
        exit(json_encode($output));
    }
?>