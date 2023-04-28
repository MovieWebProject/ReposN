<?php
    require_once('../dbReal.php') ;

    function add($userName, $firstName, $lastName, $email, $password)
    {      
        $connect = openConnection() ;

        $stm = $connect->prepare('insert into account values(?, ?, ?, ?, ?)') ;
        $stm->bind_param('sssss', $userName, $firstName, $lastName, $email, $password) ;

        $stm->execute();
        
        if($stm->affected_rows == 1) 
            return $stm->insert_id ;  // Thêm thành công: trả về id của sản phẩm vừa được thêm
                                      // . Nó là 1 con số tăng tự động của auto_increment
        return -1 ;  // Thêm thất bại
    }

    function get()
    {
        $connect = openConnection() ;

        // Ko có where nên ko cần dùng prepared statement
        $result = $connect->query('') ; 
        
        $products = array() ;

        while($row = $result->fetch_assoc())
            $products[] = $row ;
        
        return $products ;
    }

    function delete($id)
    {
        $connect = openConnection() ;

        $stm = $connect->prepare('') ;
        $stm->bind_param('i', $id) ;

        $stm->execute() ;

        return $stm->affected_rows == 1 ; // xóa thành công hoặc không thành công
    }

    function update($id, $name, $price)
    {
        $connect = openConnection() ;

        $stm = $connect->prepare('') ;
        $stm->bind_param('sii', $name, $price, $id) ;

        $stm->execute() ;

        return $stm->affected_rows == 1 ;
    }
?>