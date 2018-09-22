<?php

use yii\db\Migration;

/**
 * Class m180922_141539_alter_table_user_drop_index_unigue_on_username
 */
class m180922_141539_alter_table_user_drop_index_unigue_on_username extends Migration
{
    public function safeUp()
    {
        $this->dropIndex('username', 'user');
    }

    public function safeDown()
    {
        $this->createIndex('username', 'user', 'username', $unique = true);
    }
}
