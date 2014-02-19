<?php
function auth($login,$pass,$db)
{
    $auth = $db->SELECT('SELECT `id`,`name`, `host`, `db`, `wsserver` FROM `user`, `shard` WHERE `shard`.`id`=`user`.`id_shard` AND `login`=\''.$login.'\' AND `password`=\''.$pass.'\'');
    if(sizeof($auth)==0)
    {
        return false;
    }
    else
    {        
        return $auth[0];
    }
}

function newGameCheck($db)
{
    $check = $db->SELECT('SELECT * FROM `game` ORDER BY `id` DESC');
    if(sizeof($check)==0)
    {
        return false;
    }
    else if($check[0]['id_gamer_2']==-1)
    {
        return $check[0]['session_1'];
    }
    else
    {
        return false;
    }
}

function registration($name,$login,$password,$db)
{
    $shard = $db->SELECT('SELECT `id` FROM `shard` WHERE `size` = (SELECT MIN(`size`) FROM `shard`)');
    $db->INSERT('INSERT INTO `user` SET `name`=\''.$name.'\',`login`=\''.$login.'\', `password`=\''.md5($password).'\', `id_shard`=\''.$shard[0]['id'].'\'');
}
?>
