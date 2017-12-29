$(function(){
    // console.log($('#name').text());
    function Message(name){
        this.name = name;
        this.message;
        this.avatarUrl;
        this.date
    }
    let message = new Message($('#name').text());
    let checkTimer;
    let checkTimerMessage;
    let checkIntervalMessage = 15000;
    let checkInterval = 20000;
    
    let max = 200;
    let min = 0;
    getOnlineUser = () => {
        if(socket.readyState === WebSocket.OPEN){
            socket.send(JSON.stringify(['getAllUsers',$('#name').text()]));
        }
        checkTimer = window.setTimeout(getOnlineUser, checkInterval);
    };
    
    adminSend = (action, name) => {
        if(socket.readyState === WebSocket.OPEN){
            socket.send(JSON.stringify([action,name]));
            socket.send(JSON.stringify(['getAllUsers',$('#name').text()]));
        }
    }
    
    userLogout = () => {
        if(socket.readyState === WebSocket.OPEN){
            socket.send(JSON.stringify(['sayBye',$('#name').text()]));
            socket.close();
        }
    }
    
    $('#send').on('click', function(){
        if(!$('#message').val()){
            $().toastmessage('showErrorToast', "Сообщение не может быть пустым!");
            return;
        }
//        var $button = $(this);
        $(document).queue(function () {
            let date = new Date();
            date = date.getDate()+'-'+date.getMonth()+'-'+date.getFullYear() + ' ' + date.toLocaleString("ru",{hour:'numeric',minute:'numeric'});
            if(socket.readyState === WebSocket.OPEN && $('#message').val()){
                message.message = $('#message').val();
                message.name = $('#name').text();
                message.avatarUrl = $('#avatar').attr('src');
                message.date = date;
//                console.dir(message);
                socket.send(JSON.stringify(message));
                $('#message').val('');
            }
//            $button.attr('disabled', 'disabled');
            setTimeout(function () {
//                $button.removeAttr('disabled');
                $(document).dequeue();
            }, 15000);
        });
    });
    $('.logout').on('click', userLogout);
    
//    console.log($.cookie('access_token'));
    var socket = new WebSocket("ws://maybechat.ddns.net:8080");
//    socket.readyState.onchange = () => {
//        alert(socket.readyState);
//    };
    socket.onopen = (event) => {
        console.log('connecting');
        $('#status').html('<i>Connecting to SocketServer on address </i>'+ socket.url);
        socket.send(JSON.stringify(['sayHello',$('#name').text()]));        
        getOnlineUser();
        sessionStorage.setItem('nickcolor', 'rgb('+(Math.floor(Math.random() * (max - min)) + min)+','+(Math.floor(Math.random() * (max - min)) + min)+','+(Math.floor(Math.random() * (max - min)) + min)+')');
        sessionStorage.setItem('msgcolor', 'rgb('+(Math.floor(Math.random() * (max - min)) + min)+','+(Math.floor(Math.random() * (max - min)) + min)+','+(Math.floor(Math.random() * (max - min)) + min)+')');
        $('.uname').css('color', sessionStorage.getItem('nickcolor'));
    };
    socket.onclose = (e) => {        
        console.log('connection close');
        $('#status').html('Connection closed');
        let code = e.code;
        let mes = e.reason;
        let wasClean = e.wasClean;
        if(wasClean){
            $('#status').html('Connection closed correctly');
        }else
            $('#status').html('Connection closed with error' + code+'-'+mes);
    };
    socket.onerror = (e) => {
        console.log('error appear!');
    };
    socket.onmessage = (e) => {
        if(typeof e.data === 'string'){
            let msg = null;
            try{
                msg = JSON.parse(e.data);
                if(msg.date){
//                    console.log(msg.date);
                    //сообщения
                    $('#msgs').append(`<li class="left clearfix">
                        <span class="chat-img1 pull-left">
                            <img src="` + msg.avatarUrl + `" alt="` + msg.name + `" class="img-circle">
                        </span>
                        <div class="chat-body1 clearfix">
                            <p><strong class="uname">` + msg.name + `: </strong><span class="message">` + msg.message + `</span></p>
                            <div class="chat_time pull-right">` + msg.date + `</div>
                        </div>
                    </li>`);
                    $('.uname').css('color', sessionStorage.getItem('nickcolor'));
                    $('.message').css('color', sessionStorage.getItem('msgcolor'));
                }else if(msg instanceof Array){
                    // console.dir(msg);
                    $('#online_users').html('');
                    msg.forEach(v => {
                        if(v.status){
                            $('#online_users').append(`<li class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="/web` + v.avatar_path + v.avatar_filename + `" alt="` + v.username + `" class="img-circle">
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header_sec"><strong class="primary-font">` + v.username + `</strong></div>
                                <div class="contact_sec">
                                        <span class="badge pull-right" ` + (v.status==1 ?'style="background-color:green"':'') + `>
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" disabled ` + (v.status==1 ?'checked':'') + `>Онлайн
                                        </label>
                                        </span>
                                        <span class="badge pull-right" ` + (v.mute==1 ?'style="background-color:green"':'style="background-color:red"') + `>
                                        <label class="form-check-label">
                                        <input class="form-check-input" onchange="adminSend(\'tumbler\',\'` + v.username + `\')" type="checkbox" ` + (v.mute==1 ?'checked value="Вкл.">Вкл.':'value="Откл.">Откл.') + `
                                        </label>
                                        </span>
                                        <span class="badge pull-right" ` + (v.ban==0 ?'style="background-color:green"':'style="background-color:red"') + `>
                                        <label class="form-check-label" ` + (v.ban==0 ?'style="text-decoration:line-through"':'') + `>
                                        <input class="form-check-input" onchange="adminSend(\'ban\',\'` + v.username + `\')" type="checkbox" ` + (v.ban==0 ?'checked':'') + `>Бан
                                        </label>
                                        </span>
                                    </div>
                            </div>
                    </li>`);                            
                        }else{
                            //отключение
                            if(v.mute == 0){
                                $('.message_write').hide();
                                userLogout();
                                $('#online_users').html('');
                                $('#msgs').html('');
                                $().toastmessage('showErrorToast', "Вы были отключены админом!");
                                return;
                            }
                            //бан
                            if(v.ban == 1 && !$('#send').hasClass('disabled')){
                                $('#send').addClass('disabled');
                                $().toastmessage('showWarningToast', "Вы были забанены админом!");
                                $().toastmessage('showNoticeToast', "Вы можете только просматривать чат");
                                $().toastmessage('showNoticeToast', "И не можете отправлять сообщения");
                            }else if(v.ban == 0 && $('#send').hasClass('disabled')){
                                $('#send').removeClass('disabled');
                                $().toastmessage('showNoticeToast', "Вы можете использовать чат");
                            }
                            
                            //юзеры
                            $('#online_users').append(`<li class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="/web` + v.avatar_path + v.avatar_filename + `" alt="` + v.username + `" class="img-circle">
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header_sec"><strong class="primary-font">` + v.username + `</strong></div>
                            </div>
                    </li>`);
                        }
                        
                    });
                    
                }
                
            }catch(err){
                $('#msgs').append('<li class="left clearfix"><div class="chat-body1 clearfix"><p>'+e.data+'</p></div></li>');
            }
        }
    };
});