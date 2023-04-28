<?php
    require_once('../dbReal.php') ;

    

    function find($name)
    {
        $connect = openConnection() ;

        // Ko có where nên ko cần dùng prepared statement
        $result = $connect->prepare('select * from movies where title like ?') ; 
        $result->bind_param('s', $name) ;
        $result->execute();
        $res = $result->get_result();

        $movies = array() ;

        while($row = $res->fetch_assoc())
            $movies[] = $row ;
        
        return $movies ;
    }
?>