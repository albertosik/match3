<?php
session_start();
if(isset($_GET['logout']))
{
    session_unset();
    session_destroy();
}
require_once 'header.php';

if(isset($_SESSION['userid']))
{
    require 'game.php';
}
else
{
    require 'authform.php';
}
require_once 'footer.php';
?>



