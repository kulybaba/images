<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m180827_114703_create_comment_table extends Migration
{
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
	    'created_at' => $this->integer()->notNull(),
	    'updated_at'=> $this->integer()->notNull(),	
        ]);
    }

    public function down()
    {
        $this->dropTable('comment');
    }
}
