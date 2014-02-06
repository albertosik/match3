<?php
function auth($login,$pass,$db)
{
    $auth = $db->SELECT('SELECT * FROM `user` WHERE `login`=\''.$login.'\' AND `password`=\''.$pass.'\'');
    if(sizeof($auth)==0)
    {
        return false;
    }
    else
    {
        return $auth;
    }
}

function newGameCheck($db)
{
    $check = $db->SELECT('SELECT * FROM `game` WHERE `id_gamer_2`=\'-1\'');
    if(sizeof($check)!=0)
    {
        return true;
    }
    else
    {
        return false;
    }
}
?>
