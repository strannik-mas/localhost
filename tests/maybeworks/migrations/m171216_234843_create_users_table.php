<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m171216_234843_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id'        => $this->primaryKey(),
            'username'     => 'string NOT NULL',
            'password'  => 'string NOT NULL',
            'role'      => 'smallint NOT NULL',
            'status'      => 'smallint NOT NULL',
            'avatar_path'  => 'string',
            'avatar_filename'  => 'string'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
