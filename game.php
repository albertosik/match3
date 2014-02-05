<div id="match3"></div>
<div id="removed" style="float: right"></div>
<div id="win" style="float: right"></div>
<script>
var digits;
var colors = ['red','green','blue','yellow'];
function draw(count)
{
    digits=[];
    for(var i=0; i<count; i++)
    {
        digits[i] = [];
        for(var j=0; j<count+10; j++)
        {	
            digits[i][j] = new box(j,i,colors[Math.floor(Math.random()*10%4)],'d'+i+'l'+j,450/count);
        }
    }
}
draw(15);

//console.log(JSON.stringify(digits));
</script>