<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chat`.
 */
class m171216_234851_create_chat_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('chat', [
            'id'            => $this->primaryKey(),
            'author_id'     => $this->integer(11),
            'message'       => 'string NOT NULL',
            'date'          => 'timestamp NOT NULL'
        ]);
        $this->addForeignKey('chat_user_id', 'chat', 'author_id', 'users', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('chat');
    }
}
