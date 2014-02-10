<?php
session_start();
//unset($_SESSION);
//session_destroy();
require_once 'header.php';
require_once 'classDb.php';
require_once 'lib.php';
$db = new classDb('localhost', 'root', '', 'match3');
//print_r($_SESSION);
if(isset($_SESSION['userid']))
{
    require 'game.php';
}
else if(isset($_POST['submit']))
{
    $auth = auth($_POST['login'],md5($_POST['password']),$db);    
    if($auth)
    {
        print_r($auth);
        $_SESSION['userid'] = $auth['id'];
        $_SESSION['name'] = $auth['name'];
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



