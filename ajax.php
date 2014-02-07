<?php
require_once 'classDb.php';
$db = new classDb('localhost', 'root', '', 'match3');
if($_POST['cmd']=='newGame')
{
    $db->INSERT('INSERT INTO `game` SET `id_gamer_1`=\'1\', `id_gamer_2`=\'-1\', `layout`=\''.$_POST['layout'].'\'');
}
else if($_POST['cmd']=='getLayout')
{
    $layout = $db->SELECT('SELECT `layout` FROM `game` WHERE `id_gamer_2`=\'-1\'');
    echo $layout[0]['layout'];
    $db->UPDATE('UPDATE `game` SET `id_gamer_2`=\'2\'');
}
?>
