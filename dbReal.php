<?php
    function openConnection() {
        $host = 'localhost' ;
        $user = 'root' ;
        $pass = '' ;
        $database = 'movie_web' ;

        $connect = new mysqli($host, $user, $pass, $database) ;

        if($connect->error)
            die('Cannot connect: ' . $connect->error) ;
        
        return $connect ;
    }
?>