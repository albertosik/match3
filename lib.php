<?php
function auth($login,$pass,$db)
{
    $auth = $db->SELECT('SELECT `id`,`name` FROM `user` WHERE `login`=\''.$login.'\' AND `password`=\''.$pass.'\'');
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
    else if($check[0]['id_gamer_1']==$_SESSION['userid'] && $check[0]['id_gamer_2']==-1)
    {
        return 'myGame';
    }
    else if($check[0]['id_gamer_2']==-1)
    {
        return 'existNewGame';
    }
    else
    {
        return false;
    }
}
?>
