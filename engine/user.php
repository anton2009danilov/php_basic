<?

function getUsersList() {
    $sql = "SELECT * FROM `users`";
    return getAssocResult($sql);
}