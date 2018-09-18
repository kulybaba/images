<?php

use yii\db\Migration;

/**
 * Class m180918_121212_alter_table_comment_add_foreign_key_comment_post_id_post_id
 */
class m180918_121212_alter_table_comment_add_foreign_key_comment_post_id_post_id extends Migration
{
    public function up()
    {
        $this->addForeignKey('fk-comment-post_id-post-id', 'comment', 'post_id', 'post', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk-comment-post_id-post-id', 'comment');
    }
}
