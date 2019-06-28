<?

function add_to_basket($id) {
    $item_id = $id;
    // $user_id = $_SESSION['user'];
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    } else {
        $user_id = session_id();
    }
    // return($item_id);
    
    $db = getDb();

    $select = "SELECT * FROM `basket` WHERE `item_id`= {$item_id} AND
               `user_id` = '{$user_id}'";
    
    $result = mysqli_fetch_assoc(executeQuery($select));
    
    
    if(!$result) {
        $insert = "INSERT INTO `basket` (`item_id`, `user_id`, `quantity`)
                   VALUES ({$item_id}, '{$user_id}', 1)";
        executeQuery($insert);
    } else {
        $update = "UPDATE `basket` SET `quantity` = (`quantity` + 1) WHERE id = {$result['id']}";
        executeQuery($update);
    }
}

function delete_from_basket($id) {
    $item_id = $id;
    if (isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    } else {
        $user_id = session_id();
    }

    $db = getDb();

    $select = "SELECT * FROM `basket` WHERE `item_id`= {$item_id} AND
               `user_id` = '{$user_id}'";
    
    $result = mysqli_fetch_assoc(executeQuery($select));
    // return($result['quantity']);
    // return($result['id']);
    
    if($result['quantity'] == 1) {
        $insert = "DELETE FROM `basket` WHERE id = {$result['id']}";
        executeQuery($insert);
    } else {
        $update = "UPDATE `basket` SET `quantity` = (`quantity` - 1) WHERE id = {$result['id']}";
        executeQuery($update);
        return($result['quantity'] - 1);
    }

}


function getBasket() {
    if (isset($_SESSION['id'])) 
        $user_id = $_SESSION['id'];
    else 
        $user_id = session_id();
    
    $sql = "SELECT `basket`.`item_id`, `basket`.`user_id`, `basket`.`quantity`,
            `gallery`.`item_name`, `gallery`.`price`
            FROM `basket`
            LEFT JOIN `gallery` ON `basket`.`item_id`=`gallery`.`id`
            WHERE `basket`.`user_id`={$user_id}";
    $result = executeQuery($sql);
    return $result;
}