<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $role
 * @property integer $status
 * @property string $avatar_path
 * @property string $avatar_filename
 * @property string $auth_key
 * @property string $access_token
 *
 * @property Chat[] $chats
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'role', 'status'], 'required'],
            [['role', 'status'], 'integer'],
            [['username', 'password', 'avatar_path', 'avatar_filename'], 'string', 'max' => 255],
            [['auth_key', 'access_token'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Login',
            'password' => 'Password',
            'role' => 'Role',
            'status' => 'Status',
            'avatar_path' => 'Avatar Path',
            'avatar_filename' => 'Avatar Filename',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['author_id' => 'id']);
    }
}
