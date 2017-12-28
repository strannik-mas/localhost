window.onload = function(){
    let label = document.getElementById('status');
    let message = document.getElementById('message');
    let btnSend = document.getElementById('send');
    let btnStop = document.getElementById('stop');
    let msgs = document.getElementById('msgs');
    let name = document.getElementById('name');
    
    function User(name){
        this.name = name;
        this.message;
    }
    var user = new User(name.value);
    
    document.ondrop = function(e){
        let file = e.dataTransfer.files[0];
        if(socket.readyState === WebSocket.OPEN){
            socket.send(file);
        }
        return false;
    };
    document.ondragover = function(e){
        e.preventDefault();
    };
    
    function sendMessage(){
        if(socket.readyState === WebSocket.OPEN){
            user.message = message.value;
            user.name = name.value;
            socket.send(JSON.stringify(user));
            message.value = '';
        }
    }
    
    /*
     * WebSocket.OPEN 
     * WebSocket.CONNECTING
     * WebSocket.CLOSING
     * WebSocket.CLOSED
     * socket.bufferdAmount - количество байт, которое стоит в очереди на отсылку
     */
    btnSend.onclick = function(){        
        sendMessage();    
    };
    btnStop.onclick = function(){
        if(socket.readyState === WebSocket.OPEN)
            socket.close();
    };
    message.onkeypress = function(e){
        if(e.keyCode === 13) 
                sendMessage();
    }
    /**
     * 1. Поддержка объекта WS браузерами
     * 2. Создание объекта
     * 3. Соединение с сервером
     * 4. Назначение обработчиков событий
     * 5. Обмен информацией с сервером
     * 6. Закрытие соединения
     */
//    var socket = new WebSocket("ws://echo.websocket.org");
    var socket = new WebSocket("ws://localhost:8080");
    socket.onopen = function(event){
        console.log('connecting');
        label.innerHTML = '<i>Connecting to SocketServer on address </i>'+ socket.url;
    };
    socket.onclose = function(e){
        console.log('connection close');
        label.innerHTML = 'Connection closed';
        let code = e.code;
        let mes = e.reason;
        let wasClean = e.wasClean;
        if(wasClean){
            label.innerHTML = 'Connection closed correctly';
        }else
            label.innerHTML = 'Connection closed with error' + code+'-'+mes;
    };
    socket.onerror = function(e){
        console.log('error appear!');
    };
    socket.onmessage = function(e){
//        if(e.data instanceof ArrayBuffer)
        if(typeof e.data === 'string'){
            let strMsg = '';
            let user = null;
            let name = mess = '';
            try{
                user = JSON.parse(e.data);
                name = user.name;
                mess = user.message;
                strMsg = '<p><strong>' + name + '</strong>: ' + mess + '</p>';
            }catch(err){
                strMsg = '<p><em>'+e.data+'</p></em>';
            }
            msgs.innerHTML += strMsg;
        }else if(e.data instanceof Blob){
            alert(1);
            window.URL = window.URL || window.webkitURL;
            let source = window.URL.createObjectURL(e.data);
            let img = document.createElement('img');
            img.src = source;
            img.alt = 'Some pic';
            msgs.appendChild(img);
        }
    };
}