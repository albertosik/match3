var speed = 40;
var boxTpl = 
{
        x:0,
        y:0,
        elt:null,
        color:'',
        id:null,
        size:null,
        deleted:false,
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

function box(x, y, color, id, size, dom)
{
        this.x=x;
        this.y=y;
        this.id=id;
        this.color=color;
        this.size=size;
        if(dom)
        {
            $('#match3').append('<div class="outer" onclick="checkForRemove('+id+')" id="'+id+'" style="background-color:'+color+'; height:'+size+'px; width:'+size+'px; position:absolute; top:'+y*size+'px; left:'+x*size+'px;">\n\
            <div class="inner"></div></div>');
            this.elt=document.getElementById(id);
        }
}

box.prototype=boxTpl;
var removed = 0;
function checkForRemove(box)
{
    var current = getEltByBoxId(box.id,boxes);
    console.log(current);
    var px = current.x;
    var py = current.y;

    var i = 1;
    var toRemove = [];
    while(true)
    {
        var next = getElementByPosition(parseInt(px)+i,py,boxes);
        if(!next || !document.getElementById(next.elt.id))
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
        var prev = getElementByPosition(parseInt(px)-i,py,boxes);
        if(!prev || !document.getElementById(prev.elt.id))
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
        remove(toRemove,true);
        var win = checkForWin(boxes);
        if(win === 'lose' || win === 'win')
        {
            websocket.send('finish');
        }
        //$('#win').empty().append(win);

    }
}
function remove(toRemove,send)
{
    for(var i=0; i<toRemove.length; i++)
    {
        $('#'+toRemove[i].elt.id).remove();
        toRemove[i].deleted = true;
        if(send)
        {
            websocket.send(toRemove[i].elt.id);
            removed++;
            websocket.send('p_'+removed);
        }
        $('#removed').empty().append('Набрано очков: <br>'+removed);

        var j = 1;
        while(true)
        {
            var upper = getElementByPosition(toRemove[i].x,toRemove[i].y-j,boxes);
            if(!upper)
            {
                break;
            }
            upper.moveDown();
            j++;
        }
    }
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

function checkForWin(target)
{
    var flag = false;
    var elements = 0;
    for(var i=0; i<target.length; i++)
    {
        for(var j=0; j<target[i].length; j++)
        {
            var current = getElementByPosition(i,j,target);
            if(current && document.getElementById(current.elt.id))
            {
                elements++;

                var next = getElementByPosition(i+1,j,target);
                var prev = getElementByPosition(i-1,j,target);
                if(next && document.getElementById(next.elt.id) && next.color==current.color)
                {
                    flag = true;
                }
                if(prev && document.getElementById(prev.elt.id) && prev.color==current.color)
                {
                    flag = true;
                }
            }
        }
    }

    if(flag==false && elements>0)
        return 'lose';
    else if(elements==0)
        return 'win';
    else if(flag==true && elements>0)
        return 'process';
}