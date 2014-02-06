<?php
require_once 'header.php';
require_once 'classDb.php';
require_once 'lib.php';
$db = new classDb('localhost', 'root', '', 'match3');
if(isset($_POST['submit']))
{
    $auth = auth($_POST['login'],md5($_POST['password']),$db);    
    if($auth)
    {
        require 'game.php';
    }
    else
    {
        require 'authform.php';
    }
}
else
{
    require 'authform.php';
}
//$db = new classDb('localhost', 'root', '', 'match3');
//$db->SELECT('SELECT ');
require_once 'footer.php';
?>



