var speed = 40;
var boxTpl = 
{
        x:0,
        y:0,
        elt:null,
        color:'',
        id:null,
        moveDown:function()
        {
                $('#'+this.elt.id).animate({'top':this.y*this.size+this.size}, speed);			
                this.y++;
        },
        moveRight:function()
        {
                $('#'+this.elt.id).animate({'left':this.x*this.size+this.size}, speed);
                this.x++;
        },
        environment:function()
        {
            
        }
};

function box(x, y, color, id, size)
{
        this.x=x;
        this.y=y;
        this.id=id;
        this.color=color;
        $('#match3').append('<div class="outer" onclick="check('+id+')" id="'+id+'" style="background-color:'+color+'; height:'+size+'px; width:'+size+'px; position:absolute; top:'+y*size+'px; left:'+x*size+'px;">\n\
    <div class="inner"></div></div>');
        this.elt=document.getElementById(id);
}

box.prototype=boxTpl;

function check(box)
{
    var position = box.id.split('l');
    var px = position[1];
    var py = position[0].split('d');
    py = py[1];
    var env = getElementByPosition(parseInt(px)+1,py,digits);
    console.log(env.color);
    
    
    
}

function getElementByPosition(x,y,target)
{
    for(var i=0; i<target.length; i++)
    {
        for(var j=0; j<target[i].length; j++)
        {
            if(target[i][j].x == x && target[i][j].y == y)
            {
                return target[i][j];
            }
        }
    }
}