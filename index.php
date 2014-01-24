<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/style.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="match3"></div>
        <script>
        var digits;
        var colors = ['red','green','blue','yellow'];
        function draw(count)
        {
            //$('#match3').empty();
            digits=[];
            for(var i=0; i<count; i++)
            {
                digits[i] = [];
                for(var j=0; j<count; j++)
                {	
                    digits[i][j] = new box(j,i,colors[Math.floor(Math.random()*10%4)],'d'+i+'l'+j,450/count);
                }
            }
        }
        draw(15);
        </script>
    </body>
</html>
