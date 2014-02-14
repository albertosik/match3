<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/style.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <?php
        require_once 'lib.php';
        require_once 'classDb.php';
        $db = new classDb('localhost', 'root', '', 'match3');
        if(isset($_POST['submit']))
        {
            $auth = auth($_POST['login'],md5($_POST['password']),$db);    
            if($auth)
            {
                print_r($auth);
                $_SESSION['userid'] = $auth['id'];
                $_SESSION['name'] = $auth['name'];
            }
        }
        ?>
        <script>
            var userid = <?=$_SESSION['userid'];?>;
            var rivalsession;
        </script>
        <script src="js/script.js"></script>
        <script src="js/ws.js"></script>
    </head>
    <body>
              