<?

function createOrder($name, $email) {
    $session = session_id();
    $sql = "INSERT INTO `orders` (`name`, `email`, `session_id`) VALUES ('{$name}','{$email}','{$session}')";
    executeQuery($sql);
    session_regenerate_id();
}