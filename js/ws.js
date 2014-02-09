 var wsUri = "ws://192.168.0.108:8047/myws"; 
 websocket = new WebSocket(wsUri); 
 websocket.onclose = function(evt){onClose(evt)}; 
 websocket.onmessage = function(evt) { onMessage(evt) }; 
 websocket.onerror = function(evt) { onError(evt) }; 
 
 function onOpen(evt, msg) 
 { 
     doSend(msg); 
 } 
 function onClose(evt) 
 {
     writeToScreen("DISCONNECTED"); 
 }  
 function onMessage(evt) 
 {
     writeToScreen('<span style="color: blue;">RESPONSE: ' + evt.data+'</span>'); 
 } 
 function onError(evt)
 { 
     writeToScreen('<span style="color: red;">ERROR:</span> ' + evt.data); 
 } 
 
 function doSend(message)
 { 
    writeToScreen("SENT: " + message);  
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

