<?

function add_to_basket($id) {
    $item_id = $id;
    // $user_id = $_SESSION['user'];
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    } else {
        $session = session_id();
    }
    
    
    

    if($user_id) {
        $select = "SELECT * FROM `basket` WHERE `item_id`= {$item_id} AND `user_id` = '{$user_id}'";

        $result = mysqli_fetch_assoc(executeQuery($select))['id'];

        $insert = "INSERT INTO `basket` (`item_id`, `user_id`, `quantity`, `session`)
                   VALUES ({$item_id}, '{$user_id}', 1, '{$session}')";
        
                
    } else {
        
        $select = "SELECT * FROM `basket` WHERE `item_id`= {$item_id} AND
                `session` = '{$session}'";
        $result = mysqli_fetch_assoc(executeQuery($select));
        
        $insert = "INSERT INTO `basket` (`item_id`, `user_id`, `quantity`, `session`)
                   VALUES ({$item_id}, NULL, 1, '{$session}')";
    }

    
    
    if(!$result) {
        executeQuery($insert);
    } else {
        $update = "UPDATE `basket` SET `quantity` = (`quantity` + 1) WHERE id = {$result['id']}";
        executeQuery($update);

    }

    
    if($user_id)
        return $response['total_quantity'] = getTotalQuantity($user_id);
    else
        return $response['total_quantity'] = getTotalQuantity($session);
    
}

function delete_from_basket($id) {
    $item_id = $id;
    if (isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    } else {
        $user_id = session_id();
    }

    $select = "SELECT * FROM `basket` WHERE `item_id`= {$item_id} AND
               `user_id` = '{$user_id}'";
    
    $result = mysqli_fetch_assoc(executeQuery($select));
    // return($result['quantity']);
    // return($result['id']);
    $response = [];
    $response['total_quantity'] = getTotalQuantity($user_id) - 1;
    
    if($result['quantity'] == 1) {
        $delete = "DELETE FROM `basket` WHERE id = {$result['id']}";
        executeQuery($delete);
        
    } else {
        $update = "UPDATE `basket` SET `quantity` = (`quantity` - 1) WHERE id = {$result['id']}";
        executeQuery($update);
        $response['item_quantity'] = $result['quantity'] - 1;
    }

    return $response;

}


function getBasket() {
    if (isset($_SESSION['id'])) 
        $user_id = $_SESSION['id'];
    else if($_SESSION['user'] === 'guest')
        $user_id = session_id();
    

    $sql = "SELECT `basket`.`item_id`, `basket`.`user_id`, `basket`.`quantity`,
            `gallery`.`item_name`, `gallery`.`price`
            FROM `basket`
            LEFT JOIN `gallery` ON `basket`.`item_id`=`gallery`.`id`
            WHERE `basket`.`user_id`='{$user_id}' OR `basket`.`session` = '{$user_id}'";

    $result = executeQuery($sql);

    return $result;
}

function getTotalQuantity($user_id) {
    if(!is_null($user_id)) {
        
        if(is_numeric($user_id)) {
            $sql = "SELECT SUM(`quantity`) as total FROM `basket` WHERE `user_id` = '{$user_id}'";
        } else {
            $sql = "SELECT SUM(`quantity`) as total FROM `basket` WHERE `session` = '{$user_id}'";
        }
        $total = mysqli_fetch_assoc(executeQuery($sql))['total'];
    }
    
    
    // return mysqli_fetch_assoc(executeQuery($sql));
    
    if(is_null($total)) {
        return '0';
    }
    return $total;

}