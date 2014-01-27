var speed = 40;
var boxTpl = 
{
        x:0,
        y:0,
        elt:null,
        color:'',
        id:null,
        size:null,
        moveDown:function()
        {
                $('#'+this.elt.id).animate({'top':this.y*this.size+this.size}, speed);			
                this.y++;
        },
        moveRight:function()
        {
                $('#'+this.elt.id).animate({'left':this.x*this.size+this.size}, speed);
                this.x++;
        }
};

function box(x, y, color, id, size)
{
        this.x=x;
        this.y=y;
        this.id=id;
        this.color=color;
        this.size=size;
        $('#match3').append('<div class="outer" onclick="check('+id+')" id="'+id+'" style="background-color:'+color+'; height:'+size+'px; width:'+size+'px; position:absolute; top:'+y*size+'px; left:'+x*size+'px;">\n\
    <div class="inner"></div></div>');
        this.elt=document.getElementById(id);
}

box.prototype=boxTpl;

function check(box)
{
    var current = getEltByBoxId(box.id,digits);
    console.log(current);
    var px = current.x;
    var py = current.y;

    var i = 1;
    var toRemove = [];
    while(true)
    {
        var next = getElementByPosition(parseInt(px)+i,py,digits);
        if(!next)
        {
            break;
        }
        if(current.color == next.color)
        {
            toRemove.push(next);
            i++;
        }
        else
        {
            break;
        }
        
    }
    i = 1;
    while(true)
    {
        var prev = getElementByPosition(parseInt(px)-i,py,digits);
        if(!prev)
        {
            break;
        }
        if(current.color == prev.color)
        {
            toRemove.push(prev);
            i++;
        }
        else
        {
            break;
        }
        
    }
    if(toRemove.length>0)
    {
        toRemove.push(current);    
        for(var i=0; i<toRemove.length; i++)
        {
            $('#'+toRemove[i].elt.id).remove();

            var j = 1;
            while(true)
            {
                var upper = getElementByPosition(toRemove[i].x,toRemove[i].y-j,digits);
                if(!upper)
                {
                    break;
                }
                upper.moveDown();
                j++;
            }
        }
    }
    console.log(toRemove);
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

function getEltByBoxId(id,target)
{
    for(var i=0; i<target.length; i++)
    {
        for(var j=0; j<target[i].length; j++)
        {
            if(target[i][j].elt.id == id)
            {
                return target[i][j];
            }
        }
    }
}