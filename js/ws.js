 var wsUri = "ws://"+wsserver+":8047/myws"; 
 websocket = new WebSocket(wsUri); 
 websocket.onclose = function(evt){onClose(evt)}; 
 websocket.onmessage = function(evt) { onMessage(evt) }; 
 websocket.onerror = function(evt) { onError(evt) }; 
 
 function onOpen(evt, msg) 
 { 
     doSend('id_'+userid); 
     doSend(msg); 
 } 
 function onClose(evt) 
 {
     writeToScreen("DISCONNECTED"); 
 }  
 function onMessage(evt) 
 {     
     if(evt.data.charAt(0)==='d')
     {
         var toRemove = [];
         toRemove.push(getEltByBoxId(evt.data,boxes));
         remove(toRemove,false);
     }
     else if(evt.data === 'you winer')
     {
         $.post('ajax.php',{cmd:'win'});
         $('#win').css('display', 'block').append('Победа!!!');
     }
     else if(evt.data === 'you lose')
     {
         $.post('ajax.php',{cmd:'win'});
         $('#win').css('display', 'block').append('Поражение');
     }
     else if(evt.data.charAt(0) === 'r')
     {
         var id = evt.data.split('_');
         $.post('ajax.php',{cmd:'getName',id:id[1]}, function(data){
             $('#server').append('<p>Ваш противник: '+data+'</p>');
         });
     }
     else if(evt.data.charAt(0) === 'm')
     {
         var id = evt.data.split('_');
         $.post('ajax.php',{cmd:'newGame',id:id[1],layout:game}, function(data){
             $('#server').append('<p>Ожидается подключение проивника</p>');
         });
     }
     else if(evt.data.charAt(0) === 's')
     {
         var id = evt.data.split('_');
         $.post('ajax.php', {cmd:'getLayout',id:id[1],session_1:rivalsession}, function(data){
         drawFromLayout(JSON.parse(data));
    });
     }
     else
    {
        writeToScreen('<span>' + evt.data+'</span>'); 
    }
 } 
 function onError(evt)
 { 
     writeToScreen('<span style="color: red;">ERROR:</span> ' + evt.data); 
 } 
 
 function doSend(message)
 { 
    //writeToScreen("SENT: " + message);  
    websocket.send(message); 
 } 
 function writeToScreen(message) 
 {
     $('#server').append('<p>'+message+'</p>');
 }  
 function mail(obj)
 {	
	doSend(obj.value);
 }

