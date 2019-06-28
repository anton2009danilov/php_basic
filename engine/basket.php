<?

function add_to_basket($id){
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


function getBasket() {
    // die(var_dump(session_id()));
    if (isset($_SESSION['id'])) 
        $user_id = $_SESSION['id'];
    else 
        $user_id = session_id();
    
    // die(var_dump($user_id));
    // die(var_dump($user_id));
    $sql = "SELECT `basket`.`item_id`, `basket`.`user_id`, `basket`.`quantity`,
            `gallery`.`item_name`, `gallery`.`price`
            FROM `basket`
            LEFT JOIN `gallery` ON `basket`.`item_id`=`gallery`.`id`
            WHERE `basket`.`user_id`={$user_id}";
    $result = executeQuery($sql);
    // $result = mysqli_fetch_assoc(executeQuery($sql));
    // die(var_dump($result));
    return $result;
}