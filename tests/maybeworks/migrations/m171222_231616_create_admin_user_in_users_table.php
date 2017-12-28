<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin_user_in_users`.
 */
class m171222_231616_create_admin_user_in_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $hash = md5('admin');
        $this->insert('users', [
            'username'     => 'admin',
            'password'  => $hash,
            'role'      => 0,
            'status'    => 0,
            'avatar_path'=> '/images/',
            'avatar_filename'=>'admin.jpg',
            'auth_key'  => 'qwerty123',
            'access_token' => 'asdf123'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->delete('users', ['login' => 'admin']);
    }
}
