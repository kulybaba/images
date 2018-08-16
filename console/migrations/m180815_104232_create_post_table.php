<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m180815_104232_create_post_table extends Migration
{
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'filename' => $this->string()->notNull(),
            'description' => $this->text(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('post');
    }

}
