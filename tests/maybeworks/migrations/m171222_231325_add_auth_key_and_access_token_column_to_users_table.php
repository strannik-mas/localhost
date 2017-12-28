<?php

use yii\db\Migration;

/**
 * Handles adding auth_key_and_access_token to table `users`.
 */
class m171222_231325_add_auth_key_and_access_token_column_to_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('users', 'auth_key', $this->string(32));
        $this->addColumn('users', 'access_token', $this->string(32));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('users', 'auth_key');
        $this->dropColumn('users', 'access_token');
    }
}
