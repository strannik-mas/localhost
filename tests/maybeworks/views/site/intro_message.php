<li class="left clearfix">
    <span class="chat-img1 pull-left">
        <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">
    </span>
    <div class="chat-body1 clearfix">
        <p><strong>: </strong><?=$message->message ?></p>
        <div class="chat_time pull-right"><?=date('d-m-Y H:i', $message->date); ?></div>
    </div>
</li>