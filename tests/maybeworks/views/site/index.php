<?php
error_reporting(E_ALL);
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = 'Chat';
?>
<script src="https://use.fontawesome.com/45e03a14ce.js"></script>

<div class="main_section">
    <div class="container">
        <div class="chat_container">
            <div class="col-sm-3 chat_sidebar">
                <div class="row">
                    <div class="dropdown all_conversation">
                        <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-weixin" aria-hidden="true"></i>
                            Пользователи онлайн
                        </button>
                    </div>
                    <div class="member_list">
                        <ul class="list-unstyled" id="online_users">
                        </ul>                        
                    </div></div>
            </div>
            <!--chat_sidebar-->


            <div class="col-sm-9 message_section">
                <div class="row">
                    <div class="new_message_head">
                        <div class="pull-left"><label id="status">Статус соединения: </label></div>
                        <div class="pull-right">
                            <div class="left clearfix">
                                <span class="chat-img1 pull-left">
                                    <img src="<?= Yii::getAlias('@web') . (Yii::$app->user->isGuest ? '/images/anonymus.gif' : Yii::$app->user->identity->avatar_path . Yii::$app->user->identity->avatar_filename) ?>" alt="<?= Yii::$app->user->isGuest ? 'Гость' : Yii::$app->user->identity->username ?>" class="img-circle" id="avatar">
                                </span>
                            </div>
                            
                            <span id="name" class="uname"><?= Yii::$app->user->isGuest ? 'Гость' : Yii::$app->user->identity->username ?></span>
                        </div>
                    </div><!--new_message_head-->
                    <div class="chat_area">
                        <ul class="list-unstyled" id="msgs">
<?php
/*
foreach ($messages as $message){
    include "intro_message.php";
}
 * 
 */
?>                            
                        </ul>
                    </div><!--chat_area-->
                    <div class="message_write">
                        <textarea id="message" class="form-control" placeholder="type a message" maxlength="200" autofocus required></textarea>
                        <div class="clearfix"></div>
                        <button id="send" class="pull-right btn btn-success">
                                Send</button>
                    </div>
                </div>
            </div> <!--message_section-->
        </div>
    </div>
</div>