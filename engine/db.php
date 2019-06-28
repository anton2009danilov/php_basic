<?

function getDb() {

    static $link = null;

    if (is_null($link)) {
        $link = @mysqli_connect(HOST, USER, PASS, DB) or die('Ошибка соединения с БД: ' . 
        mysqli_connect_error());
    }

    return $link;
}

function closeDb() {
    mysqli_close(getDb());
}

function executeQuery($sql) {
    $link = getDb();
    $result = @mysqli_query($link, $sql) or die(mysqli_error($link));
    return $result;
}

function getAssocResult($sql) {
    $link = getDb();
    $result = @mysqli_query($link, $sql) or die(mysqli_error($link));
    $array_result = [];
    while($row = mysqli_fetch_assoc($result))
        $array_result[] = $row;
    return $array_result;
}

function real_escape($str){
    return mysqli_real_escape_string(getDb(), strip_tags(stripslashes($str)));
}