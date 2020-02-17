<?
// Подключаемся к базе данных
$db_host = "localhost";
$db_user = "";
$db_password = "";
$db_database = "";
$link = mysql_connect ($db_host, $db_user, $db_password);
if ($link && mysql_select_db ($db_database)) {
    mysql_query ("set names utf8");
} else {
    die ("db error");
}

// IP-адрес, который нужно проверить
$ip = "94.31.134.61";

// Преобразуем IP в число
$int = sprintf("%u", ip2long($ip));

// Ищем страну
$country_name = "";
$country_id = 0;
// Европа?
$sql = "select * from (select * from net_euro where begin_ip<=$int order by begin_ip desc limit 1) as t where end_ip>=$int";
$result = mysql_query($sql);
if (mysql_num_rows($result) == 0) {
    $sql = "select * from (select * from net_country_ip where begin_ip<=$int order by begin_ip desc limit 1) as t where end_ip>=$int";
    $result = mysql_query($sql);
}
if ($row = mysql_fetch_array($result)) {
    $country_id = $row['country_id'];
    $sql = "select * from net_country where id='$country_id'";
    $result = mysql_query($sql);
    if ($row = mysql_fetch_array($result)) {
        $country_name = $row['name_ru'];
    }
}
if ($country_id == 0) {
    echo "Страна не определена";
} else {
    echo $country_id." ".$country_name;
}

?>