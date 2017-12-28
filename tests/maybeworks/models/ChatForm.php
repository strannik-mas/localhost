<?php
namespace app\models;
use Yii;
use yii\base\Model;
class ChatForm extends Model{
    public $message;
    public $file;
    
    public function rules() {
        return [
            ['message', 'required'],
            ['file', 'file']
        ];
    }
}