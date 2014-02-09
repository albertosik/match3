<div id="match3"></div>
<div id="server" style="border: black thin solid; width: 200px"></div>
<div id="removed" style="float: right"></div>
<div id="win" style="float: right"></div>
<script>
var boxes;
var colors = ['red','green','blue','yellow'];
function createLayout(count)
{
    var layout=[];
    for(var i=0; i<count; i++)
    {
        layout[i] = [];
        for(var j=0; j<count+15; j++)
        {	
            layout[i][j] = new box(j,i,colors[Math.floor(Math.random()*10%4)],'d'+i+'l'+j,600/count);
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
if($check=='existNewGame')
{
?>
$(function(){
    $.post('ajax.php', {cmd:'getLayout'}, function(data){
        drawFromLayout(JSON.parse(data));
    });
    websocket.onopen = function(evt){onOpen(evt, 'connect')};  
});
<?php     
}
else if($check=='myGame')
{
?>
$(function(){
    $.post('ajax.php', {cmd:'getMyLastGame'}, function(data){
        drawFromLayout(JSON.parse(data));
    });
    websocket.onopen = function(evt){onOpen(evt, 'new')}; 
});
<?php
}
else
{
?>
var game = createLayout(20);
drawFromLayout(JSON.parse(game));
$(function(){
    $.post('ajax.php', {cmd:'newGame',layout:game});
    websocket.onopen = function(evt){onOpen(evt, 'new')}; 
});
<?php
}
?>
</script>