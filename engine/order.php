<?

function createOrder($name, $email) {
    $session = session_id();
    $sql = "INSERT INTO `orders` (`name`, `email`, `session_id`) VALUES ('{$name}','{$email}','{$session}')";
    executeQuery($sql);
    session_regenerate_id();
}

function getAllOrders() {
    // return $_SESSION;
    // $user_id = $_SESSION['id'];
    // $session = session_id();

    // if( isset($user_id)) {
    //     $sql = "SELECT * FROM `orders` WHERE `id` = {$user_id}";
    // } else {
    //     $sql = "SELECT * FROM `orders` WHERE `session_id` = '{$session}'";
    // }

    $sql = "SELECT * FROM `orders`";

    // $result = executeQuery($sql);
    $result = getAssocResult($sql);
    return $result;


}