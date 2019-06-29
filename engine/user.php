<?

function get_user_id($user_name) {
    $sql = "SELECT `id` FROM `users` WHERE `login` = '{$user_name}'";

    return $result = mysqli_fetch_assoc(executeQuery($sql))['id'];
    // die(var_dump($result));
    // return ;
}