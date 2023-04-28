<?php
    // Để cho trang web trả về kết quả dạng JSON
    header('Content-Type: application/json') ;
    require_once('../dbs/movies.php') ;

    if($_SERVER['REQUEST_METHOD'] != 'GET')
        die(json_encode(array('code' => 1, 'error' => 'This API is accept GET method only'))) ;
    else if(isset($_GET['tukhoa']))
    {
        $name = $_GET['tukhoa'] ;
        

        
        $getResult = find($name);

        if($getResult != -1)
                die(json_encode(array('code' => 0, 'message' => 'Get movies success', 'data' => $getResult))) ;
            else
                die(json_encode(array('code' => 4, 'error' => 'Something is wrong when get movie'))) ;
        
    }
    else
        die(json_encode(array('code' => 3, 'error' => 'Please enter name'))) ;
?>