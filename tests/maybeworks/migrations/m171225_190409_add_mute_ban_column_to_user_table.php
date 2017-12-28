<?php

use yii\db\Migration;

/**
 * Handles adding mute_ban to table `user`.
 */
class m171225_190409_add_mute_ban_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('users', 'mute', $this->integer()->notNull()->defaultValue(1));
        $this->addColumn('users', 'ban', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('users', 'mute');
        $this->dropColumn('users', 'ban');
    }
}
