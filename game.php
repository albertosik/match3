<div id="match3"></div>
<div id="name" class="status"><?=$_SESSION['name']?></div>
<div id="server" class="status"></div>
<div id="removed" class="status"></div>
<div id="win" class="status"></div>
<div id="logout" class="status"><a href="index.php?logout=1">Выход</a></div>
<script>
var boxes;
var colors = ['red','green','blue','yellow'];
function createLayout(count)
{
    var layout=[];
    for(var i=0; i<count; i++)
    {
        layout[i] = [];
        for(var j=0; j<count; j++)
        {	
            layout[i][j] = new box(j,i,colors[Math.floor(Math.random()*10%4)],'d'+i+'l'+j,300/count);
        }
    }
    layout = JSON.stringify(layout);
    return layout;
}

function drawFromLayout(layout)
{
    boxes = [];
    for(var i=0; i<layout.length; i++)
    {
        boxes[i]=[];
        for(var j=0; j<layout[i].length; j++)
        {
            boxes[i][j] = new box(layout[i][j].x,layout[i][j].y,layout[i][j].color,layout[i][j].id,layout[i][j].size,true);
        }
    }
}
<?php
$check = newGameCheck($db);
if($check)
{
?>
rivalsession = '<?=$check?>';
websocket.onopen = function(evt){onOpen(evt, 's_'+rivalsession)};  
<?php     
}
else
{
?>
var game = createLayout(10);
drawFromLayout(JSON.parse(game));
websocket.onopen = function(evt){onOpen(evt, 'new')}; 
<?php
}
?>
</script>