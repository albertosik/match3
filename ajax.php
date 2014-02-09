<?php
session_start();
require_once 'classDb.php';
$db = new classDb('localhost', 'root', '', 'match3');
if($_POST['cmd']=='newGame')
{
    echo $_SESSION['userid'];
    $db->INSERT('INSERT INTO `game` SET `id_gamer_1`=\''.$_SESSION['userid'].'\', `id_gamer_2`=\'-1\', `layout`=\''.$_POST['layout'].'\'');
}
else if($_POST['cmd']=='getLayout')
{
    $layout = $db->SELECT('SELECT `id`,`layout` FROM `game` ORDER BY `id` DESC');
    echo $layout[0]['layout'];
    $db->UPDATE('UPDATE `game` SET `id_gamer_2`=\''.$_SESSION['userid'].'\' WHERE `id`=\''.$layout[0]['id'].'\'');
}
else if($_POST['cmd']=='getMyLastGame')
{
    $layout = $db->SELECT('SELECT `id`,`layout` FROM `game` ORDER BY `id` DESC');
    echo $layout[0]['layout'];
}
?>
